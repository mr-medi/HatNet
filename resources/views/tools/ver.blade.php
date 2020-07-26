@extends('layouts.master')
@section('titulo')
Herramientas / Mostrar
@endsection
@inject('h', 'App\Herramienta')
<br><br><br>
@section('contenido')
    <script type="text/javascript" src="{{asset('js/prism.js')}}"></script>
    <script type="text/javascript">
        a();
        document.documentElement.addEventListener('keydown', function(e)
        {
            console.log(e.keyCode);
            if(e.keyCode=="32")a();
        });
    </script>
    <style type="text/css">
    /* PrismJS 1.19.0
    https://prismjs.com/download.html#themes=prism-dark&languages=markup+css+clike+javascript+arduino+bash+batch+c+csharp+cpp+java+javadoc+javadoclike+json+markdown+markup-templating+php+phpdoc+php-extras+python+regex */
    /**
     * prism.js Dark theme for JavaScript, CSS and HTML
     * Based on the slides of the talk “/Reg(exp){2}lained/”
     * @author Lea Verou
     */

    code[class*="language-"],
    pre[class*="language-"] {
    	color: white;
    	background: none;
    	text-shadow: 0 -.1em .2em black;
    	font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
    	font-size: 1em;
    	text-align: left;
    	white-space: pre;
    	word-spacing: normal;
    	word-break: normal;
    	word-wrap: normal;
    	line-height: 1.5;

    	-moz-tab-size: 4;
    	-o-tab-size: 4;
    	tab-size: 4;

    	-webkit-hyphens: none;
    	-moz-hyphens: none;
    	-ms-hyphens: none;
    	hyphens: none;
    }

    @media print {
    	code[class*="language-"],
    	pre[class*="language-"] {
    		text-shadow: none;
    	}
    }

    pre[class*="language-"],
    :not(pre) > code[class*="language-"] {
    	background: hsl(30, 20%, 25%);
    }

    /* Code blocks */
    pre[class*="language-"] {
    	padding: 1em;
    	margin: .5em 0;
    	overflow: auto;
    	border: .3em solid hsl(30, 20%, 40%);
    	border-radius: .5em;
    	box-shadow: 1px 1px .5em black inset;
    }

    /* Inline code */
    :not(pre) > code[class*="language-"] {
    	padding: .15em .2em .05em;
    	border-radius: .3em;
    	border: .13em solid hsl(30, 20%, 40%);
    	box-shadow: 1px 1px .3em -.1em black inset;
    	white-space: normal;
    }

    .token.comment,
    .token.prolog,
    .token.doctype,
    .token.cdata {
    	color: hsl(30, 20%, 50%);
    }

    .token.punctuation {
    	opacity: .7;
    }

    .token.namespace {
    	opacity: .7;
    }

    .token.property,
    .token.tag,
    .token.boolean,
    .token.number,
    .token.constant,
    .token.symbol {
    	color: hsl(350, 40%, 70%);
    }

    .token.selector,
    .token.attr-name,
    .token.string,
    .token.char,
    .token.builtin,
    .token.inserted {
    	color: hsl(75, 70%, 60%);
    }

    .token.operator,
    .token.entity,
    .token.url,
    .language-css .token.string,
    .style .token.string,
    .token.variable {
    	color: hsl(40, 90%, 60%);
    }

    .token.atrule,
    .token.attr-value,
    .token.keyword {
    	color: hsl(350, 40%, 70%);
    }

    .token.regex,
    .token.important {
    	color: #e90;
    }

    .token.important,
    .token.bold {
    	font-weight: bold;
    }
    .token.italic {
    	font-style: italic;
    }

    .token.entity {
    	cursor: help;
    }

    .token.deleted {
    	color: red;
    }
    </style><br><br>
    <div class="container">
        <span style="margin:20px">
            <a href="{{url('/')}}">
                Inicio
            </a>
            <a href="{{url('herramientas')}}" style="margin:15px;">
                Herramientas
            </a>
            <a href="{{url('herramientas/ver/')}}/{{$tool->slug}}" style="margin:15px;">
                {{ $tool->nombre }}
            </a>
        </span>
        <div class="row">
          <div class="col-sm-3">
          </div>
          <div class="col-sm-9">
              <h1>{{ $tool->nombre }}</h1>
              <strong class="d-inline-block mb-2 text-primary">{{ $tool->descripcion }}</strong>
            <h1>Autor</h1>
            <a href="{{ url('users')}}/{{$tool->user->slug }}">
              {{ $tool->user->name }}
            </a><br><br>
            @foreach ($tool->ficheros as $file)
                <h1>{{ $file->name }}</h1>
                <pre>
                    <code id="cod" class="language-{{$file->lenguaje->nombre}}"
                        contenteditable
                         spellcheck="false" tabindex="0" wrap="off">
                        {{ $file->code }}
                    </code>
                </pre>
            @endforeach
            </div>
    </div>
@endsection
