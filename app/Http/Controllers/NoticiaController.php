<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Traits\AuthTrait;

class NoticiaController extends Controller
{
    use AuthTrait;

    public function index()
    {        
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); 

            $user_news = User::findOrFail($user_id)->id;
            
            if ($user_news) {
                
                $user_data = $this->procurar_user_por_id($user_id);
                
                $news_data = $this->procurar_noticia_por_id($user_news);
                
                $list_news = $this->listarNoticiaUsuario($user_news);                
                
                return view('app.noticia.noticias', compact('user_data', 'news_data', 'list_news'));
            } else {                
                return redirect()->route('login')->with('error', 'Você não tem uma notícia associada.');
            }
        } else {            
            return redirect()->route('login')->with('error', 'Você precisa fazer login como usuário para acessar o painel.');
        }
    }
    public function noticiasRecentes($id)
    {
        $noticias = Noticia::where('id_usuario', $id)
                            ->orderBy('dt_noticia', 'DESC')
                            ->limit(3)
                            ->get();
        return $noticias;
    }
    
    public function listarNoticiaUsuario($id)
    {
        // Mapeamento de nomes amigáveis para nomes reais dos atributos do banco de dados
        $sortMapping = [
            'titulo' => 'nm_titulo',
            'data' => 'dt_noticia',
        ];
    
        // Obtenha o parâmetro de ordenação da solicitação
        $sortKey = request()->input('sort', 'id_usuario');
    
        // Verifique se o nome do atributo de ordenação é um nome amigável e, se for, obtenha o nome real do atributo
        $sortAttribute = $sortMapping[$sortKey] ?? $sortKey;
    
        // Obtenha a direção de ordenação da solicitação
        $direction = request()->input('direction', 'asc');
    
        return Noticia::where('id_usuario', $id)
            ->orderBy($sortAttribute, $direction)
            ->orderByRaw('GREATEST(created_at, updated_at) ' . $direction)
            ->paginate(10);
    }
     
    public function buscarNoticia($key, $id)
    {
        $mod = DB::table('noticia')
            ->where('id_usuario', $id)
            ->where(function ($query) use ($key) {
                $query->where('nm_titulo', 'like', "%$key%")
                      ->orWhere('dt_noticia', 'like', "%$key%");              
            })            
            ->paginate(10); 

        return $mod;
    }
    
    public function buscar(Request $request)
    {
        $key = $request->input('buscar'); 
        $idUsuario = Auth::id();

        $user_news = User::findOrFail($idUsuario)->id;

        $resultados_busca = $this->buscarnoticia($key, $user_news);

        $user_data = $this->procurar_user_por_id($user_news);
        $news_data = $this->procurar_noticia_por_id($user_news);
        $list_news = $this->listarNoticiaUsuario($user_news);

        return view('app.noticia.noticias', compact('resultados_busca', 'user_data', 'news_data', 'list_news'));
    }

    public function cadastro(Request $request)
    { 
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'conteudo' => 'required',
            'legenda' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,svg|max:10240',//10MB
        ]);

        if ($request->hasFile('imagem')) {

            $imagemPath = $request->file('imagem')->store('imagens', 'public');

            DB::table('noticia')->insert([
                'nm_titulo' => $validatedData['titulo'],
                'nm_autor' => $validatedData['autor'],
                'ds_conteudo' => $validatedData['conteudo'],
                'ds_legenda' => $validatedData['legenda'],
                'im_capa' => $imagemPath, 
                'dt_noticia' => now(),
                'created_at' => now(),
                'id_usuario' => $idUsuario
            ]);

            return redirect()->back()->with('success', 'Notícia cadastrada com sucesso.');
        }
    }

    public function atualizar(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'conteudo' => 'required',
            'legenda' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        
        $existingNews = DB::table('noticia')
            ->where('id_usuario', $idUsuario)
            ->where('nm_titulo', $validatedData['titulo'])
            ->where('id_noticia', '<>', $request->input('id')) 
            ->first();

        if ($existingNews) {
            return redirect()->back()->with('error', 'Este título já está sendo usado em outro notícia. Por favor, escolha um título diferente.');
        }
        
        if ($request->hasFile('imagem')) {

            $imagemPath = $request->file('imagem')->store('imagens', 'public');

            $updated = DB::table('noticia')
            ->where('id_noticia', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_titulo' => $validatedData['titulo'],
                'nm_autor' => $validatedData['autor'],
                'ds_conteudo' => $validatedData['conteudo'],
                'ds_legenda' => $validatedData['legenda'],
                'im_capa' => $imagemPath,
                'dt_noticia' => now(),
                'updated_at' => now()          
            ]);            
        }
       
        if ($updated) {
            return redirect()->route("app.noticia.index")->with('success', 'Informações do notícias atualizadas com sucesso');
        } else {
            return redirect()->back()->with('error', 'Notícia não encontrada');
        }
    }
 
    public function excluir($id)
    {
        $deleted = DB::table('noticia')->where('id_noticia', $id)->delete();

        if ($deleted) {
            return redirect()->route("app.noticia.index")>with('success', 'Notícia excluída com sucesso');
        } else {
            return redirect()->back()->with('error', 'Notícia não encontrada');
        }
    }

    private function procurar_noticia_por_id($id)
    {
        $news = DB::table('noticia')->where('id_noticia', $id)->first();
        return $news ? $news : false;
    }

    public function editar(Request $request)
    {
        $id = $request->input('news_id');
        $noticia = Noticia::findOrFail($id);
        return view('app.noticia.editar', compact('noticia'));
    }

    public function mostrarNoticia($id)
    {   
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $idUsuario = Auth::id();
    
            $user_news = User::findOrFail($idUsuario)->id;
            if ($user_news) {                
                $user_data = $this->procurar_user_por_id($user_news);
                $news_data = $this->procurar_noticia_por_id($id);      
                
                return view('app.noticia.show', compact('user_data', 'news_data'));  
            }
      
        }        
    }   
}
