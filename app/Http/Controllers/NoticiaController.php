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
                return redirect()->route('login')->with('error', 'Você não tem uma noticia associada.');
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
        $sort = request()->input('sort', 'id_usuario');
        $direction = request()->input('direction', 'asc');
    
        return Noticia::where('id_usuario', $id)
            ->orderBy($sort, $direction)
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
            'conteudo' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', 
            'data' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $date = strtotime($value);
                    $minDate = strtotime('2000-01-01');
                    $maxDate = strtotime('2030-12-31');

                    if ($date < $minDate || $date > $maxDate) {
                        $fail('A data deve estar entre os anos 2000 e 2030.');
                    }
                },
            ],
        ]);

        if ($request->hasFile('imagem')) {

            $imagemPath = $request->file('imagem')->store('imagens', 'public');

            DB::table('noticia')->insert([
                'nm_titulo' => $validatedData['titulo'],
                'ds_conteudo' => $validatedData['conteudo'],
                'im_capa' => $imagemPath, 
                'dt_noticia' => $validatedData['data'],
                'id_usuario' => $idUsuario
            ]);

            return redirect()->back()->with('success', 'noticia cadastrada com sucesso.');
        }
    }

    public function atualizar(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'titulo' => 'required',
            'conteudo' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'data' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $date = strtotime($value);
                    $minDate = strtotime('2000-01-01');
                    $maxDate = strtotime('2030-12-31');

                    if ($date < $minDate || $date > $maxDate) {
                        $fail('A data deve estar entre os anos 2000 e 2030.');
                    }
                },
            ],
        ]);
        
        $existingNews = DB::table('noticia')
            ->where('id_usuario', $idUsuario)
            ->where('nm_titulo', $validatedData['titulo'])
            ->where('id_noticia', '<>', $request->input('id')) 
            ->first();

        if ($existingNews) {
            return ['errorMessage' => 'Este título já está sendo usado em outro notícia. Por favor, escolha um título diferente.'];
        }
        
        if ($request->hasFile('imagem')) {

            $imagemPath = $request->file('imagem')->store('imagens', 'public');

            $updated = DB::table('noticia')
            ->where('id_noticia', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_titulo' => $validatedData['titulo'],
                'ds_conteudo' => $validatedData['conteudo'],
                'im_capa' => $imagemPath,
                'dt_noticia' => $validatedData['data'],           
            ]);            
        }
       
        if ($updated) {
            return redirect()->route("app.noticia.index");
            /*return ['successMessage' => 'Informações do noticia atualizadas com sucesso'];*/
        } else {
            return ['errorMessage' => 'noticia não encontrado'];
        }
    }
 
    public function excluir($id)
    {
        $deleted = DB::table('noticia')->where('id_noticia', $id)->delete();

        if ($deleted) {
            return ['successMessage' => 'noticia excluída com sucesso'];
        } else {
            return ['errorMessage' => 'noticia não Encontrada'];
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
