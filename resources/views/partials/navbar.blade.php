

<nav
class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
  <a class="navbar-brand"
  href="http://hatnet-f.ddns.net:80/HatNet/hatnet/public/">
    HatNet
   </a>
  <div class="navbar-header">
      <button class="navbar-toggler" type="button"
      data-toggle="collapse"
      data-target="#navbarCollapse"
      aria-controls="navbarCollapse"
      aria-expanded="false"
       aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  </div>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="nav navbar-nav mr-auto">
      <!--RETOS-->
      <li class="active">
        <a href="{{url('/retos')}}" class="nav-link {{ Request::is('retos*') &&
          !Request::is('retos/crear')? ' active' : ''}}">
          Retos
        </a>
      </li>
      <!--CREAR RETOS-->
      <li class="nav-item">
        <a href="{{url('/retos/crear')}}" class="nav-link {{ Request::is('addReto')? ' active' : ''}}">
          Nuevo reto
        </a>
      </li>
      <!--MI PERFIL-->
      <li class="nav-item">
        <a href="{{
          isset(Auth::user()->name) ? url('users').'/'.Auth::user()->slug : url('/login')  }}"
          class="nav-link {{ Request::is('user')? ' active' : ''}}">
            Mi perfil
        </a>
      </li>
      <!--MI PERFIL-->
      <li class="nav-item">
        <a href="{{
          isset(Auth::user()->name) ? url('/mensajes') : url('/login')  }}"
          class="nav-link {{ Request::is('user')? ' active' : ''}}">
            Mensajes
        </a>
      </li>
      <!--COMUNIDAD-->
      <li class="nav-item">
        <a href="{{url('/comunidad')}}" class="nav-link {{
          Request::is('comunidad')? ' active' : ''}}">
          Comunidad
        </a>
      </li>
      <!--TOOLS-->
      <li class="nav-item">
        <a href="{{url('/herramientas')}}" class="nav-link">
          Herramientas
        </a>
      </li>
      <!--API-->
      <li class="nav-item">
        <a href="{{url('/api')}}" class="nav-link">
          API
        </a>
      </li>
    </ul>

    @if(Auth::check() )
        <!--BUSQUEDA!!!!!!!!!!!!!!!!!!!!!!!!-->
        <form class="form-inline mt-2 mt-md-0">
          <input id="busqueda" name="busqueda" class="form-control mr-sm-3" type="text" placeholder="Buscar" aria-label="Buscar">
        </form><BR>
        <table  id="log" data-classes="table table-condensed"
                data-toggle="table"
    data-url=""
    data-select-item-name="subscriber_key"
    data-id-field="Newsletter_SubKey"
    data-click-to-select="true"
    data-buttons-align="right"
    data-show-columns="true"
    data-toolbar="#toolbar"
    data-toolbar-align="left"
    data-search="true"
    data-pagination="true"
    data-show-pagination-switch="true"
    >
    <thead>
    <tr>
        <th data-field="Email_Address" data-sortable="true" data-visible="true" data-title-tooltip="Newsletter_Master: Email_Address">
        </th>
    </tr>
  </thead>
</table>

        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a href="{{ route('logout') }}"  class="nav-link"
                  onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();" >
                    <span class="glyphicon glyphicon-off"></span>
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    @else
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
              <a href="{{url('/login')}}" class="nav-link">Login</a>
            </li>
        </ul>
    @endif
  </div>
</nav>
<!--CODIGO PARA PETICIONES AJAX-->
<script type="text/javascript">
  $(document).ready(function()
  {
    function log( message )
    {
       $( "#log" ).scrollTop( 0 );
    }

    $("#busqueda").autocomplete(
     {
        source: function( request, response )
        {
            var formulario = $( "#busqueda" ).val();
            $.ajax
            ({
                url : '/busquedaAjax',
                type : 'POST',
                data :
                {
                  "_token":"{{ csrf_token() }}",
                  "busqueda":formulario
                },
                dataType : 'json',
                success : function( json )
                {
                    $( "#log" ).empty();
                    $.each(json, function(i, item)
                    {
                        console.log(item.user);
                      data21 = item;
                      data22 = item;
                    });
                    for(let i in json)
                    {
                        console.log(json);
                        //$( "#log" ).append(json[i].name + "<br>");
                        var tableInfo  = json[i].name;
                        var tableHeading  = tableInfo.Email_Address;
                        var tableRef = document.getElementById('log');
                        // Insert a row in the table at row at last index
                        var newRow   = tableRef.insertRow(tableRef.rows.length);
                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        // Append a text node to the cell
                        var newText  = document.createTextNode(json[i].name);
                        newCell.appendChild(newText);
                    }
                }
            });
        }
    });
  });
 </script>
