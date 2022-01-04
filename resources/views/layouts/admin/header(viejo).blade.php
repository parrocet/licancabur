<li class="nav-item dropdown">
    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
        <span><i class="notika-icon notika-mail"></i></span></a>
        
        @php $comentarios=mensajes(); @endphp
        @if(count($comentarios)>0)
        <div role="menu" class="dropdown-menu message-dd animated zomIn">
        <div class="hd-mg-tt">
            <h2>Comentarios</h2>
        </div>
        @for($i=0;$i<count($comentarios);$i++)
        <div class="hd-message-info">
            <a onclick="marcar_comentario_visto('{{ $comentarios[$i][4] }}','{{ $comentarios[$i][2] }}','{{ $comentarios[$i][3] }}')">
                <div class="hd-message-sn">
                    <div class="hd-message-img">
                        <img src="{{ asset('assets/img/post/3.jpg') }}" alt="" />
                    </div>
                    <div class="hd-mg-ctn">
                        <h3>{{ $comentarios[$i][0] }}</h3>
                        <p>{{ $comentarios[$i][1] }}</p>
                    </div>
                </div>
            </a>
        @endfor
        {{-- <div class="hd-mg-va">
            <a href="#">Ver Todos</a>
        </div> --}}
    </div>
            @endif
</li>