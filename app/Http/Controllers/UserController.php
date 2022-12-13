<?php
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Http;
  use App\Http\Requests\PostRequest;

  class UserController extends Controller {
    public function show(Request $request) {
      if ($request->email) {
        $response = Http::get('https://gorest.co.in/public/v2/users?email='. $request->email);
        if ($response->body() !== "[]") {
          $renombrarLlave = array("name" => "nombre", "gender" => "genero", "status" => "activo");
          $usuarios = array();
          foreach ($response->json() as $usuario) {
            $nuevoUsuario = array();
            foreach ($usuario as $llave => $valor) {
              if (array_key_exists($llave, $renombrarLlave)) {
                $nuevoUsuario[$renombrarLlave[$llave]] = $valor;
              } else {
                $nuevoUsuario[$llave] = $valor;
              }
            }
            array_push($usuarios, $nuevoUsuario);
          }
          return $usuarios;
        } else {
          return response()->json([
            'estado' => 'Error',
            'mensaje' => 'Correo no encontrado.',
          ]);
        }
      } else {
        $response = Http::get('https://gorest.co.in/public/v2/users');
        $renombrarLlave = array("name" => "nombre", "gender" => "genero", "status" => "activo");
        $usuarios = array();
        foreach ($response->json() as $usuario) {
          $nuevoUsuario = array();
          foreach ($usuario as $llave => $valor) {
            if (array_key_exists($llave, $renombrarLlave)) {
              $nuevoUsuario[$renombrarLlave[$llave]] = $valor;
            } else {
              $nuevoUsuario[$llave] = $valor;
            }
          }
          array_push($usuarios, $nuevoUsuario);
        }
        return $usuarios;
      }
    }

    public function store(PostRequest $request) {
      $response = Http::withToken('187daebae594b93debd257e9e117c0cac4c48690425d66f8ef2854f6f343c7f6')->post('https://gorest.co.in/public/v2/users', [
        'name' => $request->nombre,
        'email' => $request->email,
        'gender' => $request->genero,
        'status' => $request->activo,
      ]);
      $renombrarLlave = array("name" => "nombre", "gender" => "genero", "status" => "activo");
      $usuarios = array();
      $nuevoUsuario = array();
      foreach ($response->json() as $llave => $valor) {
        if (array_key_exists($llave, $renombrarLlave)) {
          $nuevoUsuario[$renombrarLlave[$llave]] = $valor;
        } else {
          $nuevoUsuario[$llave] = $valor;
        }
      }
      array_push($usuarios, $nuevoUsuario);
      return $usuarios;
    }

    public function update(PostRequest $request) {
      $usuario = Http::get('https://gorest.co.in/public/v2/users?email='. $request->email);
      if ($usuario->body() !== "[]") {
        $respuesta = Http::withToken('187daebae594b93debd257e9e117c0cac4c48690425d66f8ef2854f6f343c7f6')->put('https://gorest.co.in/public/v2/users/'.$usuario->json()[0]["id"], [
          'name' => $request->nombre,
          'email' => $request->email,
          'gender' => $request->genero,
          'status' => $request->activo,
        ]);
        $renombrarLlave = array("name" => "nombre", "gender" => "genero", "status" => "activo");
        $usuarios = array();
        $nuevoUsuario = array();
        foreach ($respuesta->json() as $llave => $valor) {
          if (array_key_exists($llave, $renombrarLlave)) {
            $nuevoUsuario[$renombrarLlave[$llave]] = $valor;
          } else {
            $nuevoUsuario[$llave] = $valor;
          }
        }
        array_push($usuarios, $nuevoUsuario);
        return $usuarios;
      } else {
        return response()->json([
          'estado' => 'Error',
          'mensaje' => 'Correo no encontrado.',
        ]);
      }
    }
  }