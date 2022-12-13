<?php
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Http;

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
  }
