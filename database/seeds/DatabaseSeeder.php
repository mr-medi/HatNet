<?php
use App\Category;
use Illuminate\Database\Seeder;
use App\User;
use App\Status;
use App\Language;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  private $categorias = [
                        ["nombre"=>"Entorno-Cliente",
                        "descripcion"=>"Aprende a explotar vulnerabilidades de aplicaciones web para impactar sus usuarios o saltar los mecanismos de segurida",
                        "ruta"=>"http://retos.hatnet.com:81/Entorno-Cliente/",
                        "logo"=>"script.svg"
                        ],
                        ["nombre"=>"Entorno-Servidor",
                        "descripcion"=>"Estos retos te permitiran aprender técnicas intrusivas en la web.",
                        "ruta"=>"http://retos.hatnet.com:81/Entorno-Servidor/",
                        "logo"=>"server.svg"
                        ],
                          ["nombre"=>"Ingenieria-Inversa",
                          "descripcion"=>"Retos basados en cracking. Básicamente analizar y romper ficheros binarios",
                          "ruta"=>"http://retos.hatnet.com:81/Ingenieria-Inversa/",
                          "logo"=>"reversing.svg"
                        ],
                          ["nombre"=>"Estenografia",
                          "descripcion"=>"Si la criptografía es el arte del secreto, la esteganografía es el arte del disimulo ",
                            "ruta"=>"http://retos.hatnet.com:81/Estenografia/",
                          "logo"=>"estenografia.svg"
                        ],
                        ["nombre"=>"Criptografia",
                        "descripcion"=>"Busca la solución atacando sistemas de encriptación más o menos sólidos",
                          "ruta"=>"http://retos.hatnet.com:81/Criptografia/",
                        "logo"=>"cript.svg"
                      ],
                        ["nombre"=>"Redes",
                        "descripcion"=>"Pon de tu lado analizando y manipulando los protocolos y servicios de red más comunes.",
                          "ruta"=>"http://retos.hatnet.com:81/Redes/",
                        "logo"=>"network.svg"
                      ],
                        ["nombre"=>"Sistemas",
                        "descripcion"=>"APLICACIONES - SISTEMA. Aquí los retos a superar se basan en debilidades debidas a errores de programación en ciertos",
                        "ruta"=>"http://retos.hatnet.com:81/Sistemas/",
                        "logo"=>"sis.svg"
                      ]];


  private $status = [
                        ["nombre"=>"newbie",
                        "color"=>"green",
                        "logo"=>"newbie.png",
                        ],
                        ["nombre"=>"programmer",
                        "color"=>"lightgrey",
                        "logo"=>"programmer.svg",
                        ],
                        ["nombre"=>"hacker",
                        "color"=>"red",
                        "logo"=>"hacker.svg",
                        ],
                        ["nombre"=>"FuckingBoss",
                        "color"=>"yellow",
                        "logo"=>"boss.svg",
                        ]
                    ];

    private $languages =
                        [
                            ["nombre"=>"javascript","ext"=>"js"],
                            ["nombre"=>"php","ext"=>"php"],
                            ["nombre"=>"C","ext"=>"c"],
                            ["nombre"=>"C++","ext"=>"cpp"],
                            ["nombre"=>"java","ext"=>"java"],
                            ["nombre"=>"python","ext"=>"py"]
                        ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categorias')->delete();
      foreach ($this->categorias as $categoria)
      {
        $c = new Category();
        $c->categoria = $categoria["nombre"];
        $c->slug = Str::slug($categoria["nombre"]);
        $c->descripcion = $categoria["descripcion"];
        $c->rutaCategoriaServidor = $categoria["ruta"];
        $c->logo = $categoria["logo"];
        $c->save();
      }
      //
      DB::table('status')->delete();
      foreach ($this->status as $status)
      {
        $s = new Status();
        $s->nombre = $status["nombre"];
        $s->color = $status["color"];
        $s->logo = $status["logo"];
        $s->save();
      }

      //
     // DB::table('lenguajes')->delete();
      foreach ($this->languages as $l)
      {
        $s = new Language();
        $s->nombre = $l["nombre"];
        $s->ext=$l["ext"];
        $s->save();
      }

    //DB::table('users')->delete();
	$user = new User();
	$user->name = "Mentor";
    $user->slug=Str::slug($user->name);
	$user->email="a@a";
	$user->password=bcrypt('12341234');
    $user->idStatus=1;
	$user->save();

    $user = new User();
    $user->name = "El pep´´ Best";
    $user->slug=Str::slug($user->name);
	$user->email="b@b";
	$user->password=bcrypt('12341234');
    $user->idStatus=1;
	$user->save();

    $user = new User();
    $user->name = "Bond";
    $user->slug=Str::slug($user->name);
	$user->email="c@c";
	$user->password=bcrypt('12341234');
    $user->idStatus=1;
	$user->save();
    }
}
