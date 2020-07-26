@extends('layouts.master')
@section('titulo')
API / REST
@endsection
@section('contenido')
    <script type="text/javascript" src="{{asset('js/prism.js')}}"></script>
    <script type="text/javascript">
        a();
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
    </style>
<br><br><br><br>

<div class="container">
    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
       <a href="{{url('api')}}" style="margin:15px;">
           API
      </a>
      <a href="{{url('api/rest')}}" style="margin:15px;">
          REST
     </a>
    </span>
    <BR><BR><BR>
    <img src="{{ asset('assets/imagenes/api.svg') }}" width="80" height="80"
     style="margin:10px">
    <h1>api.hatnet.com</h1>

    <a href="{{url('/api/rest/retos')}}">/retos</a>

    <pre class=" language-python">
        <code id="cod" class=" language-python"
            contenteditable
             spellcheck="false" tabindex="0" wrap="off">

             #!/usr/bin/python
            import requests,json
            resp = requests.get("https://api.hatnet.com/retos")
            if resp.status_code != 200:
                print('[ ! ]FAILED REQUEST')
            data = resp.json()
            print(json.dumps(data, indent=4, sort_keys=True))


        </code>
    </pre>
    <br>
    <a href="{{url('/api/rest/reto/1')}}">/retos/idReto</a>
    <pre class=" language-python">
        <code id="cod" class=" language-python"
            contenteditable
             spellcheck="false" tabindex="0" wrap="off">

             #!/usr/bin/python
            import requests,json
            resp = requests.get("https://api.hatnet.com/retos/1")
            if resp.status_code != 200:
                print('[ ! ]FAILED REQUEST')
            data = resp.json()
            print(json.dumps(data, indent=4, sort_keys=True))


        </code>
    </pre>

    <br>
    <a href="{{url('/api/rest/user/mentor')}}">/users/nombreUser</a>
    <pre class=" language-python">
        <code id="cod" class=" language-python"
            contenteditable
             spellcheck="false" tabindex="0" wrap="off">

             #!/usr/bin/python
            import requests,json
            resp = requests.get("https://api.hatnet.com/users/mentor")
            if resp.status_code != 200:
                print('[ ! ]FAILED REQUEST')
            data = resp.json()
            print(json.dumps(data, indent=4, sort_keys=True))


        </code>
    </pre>
    <br>
</div>
