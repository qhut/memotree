<aside class="bg-dark lter aside-md hidden-print" id="nav">
    <section class="vbox">
        <header class="header bg-primary lter text-center clearfix">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project">
                    <i class="fa fa-plus"></i>
                </button>
                <div class="btn-group hidden-nav-xs">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"> Switch Project
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-left">
                        <li><a href="#">Project</a></li>
                        <li><a href="#">Another Project</a></li>
                        <li><a href="#">More Projects</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                    <ul class="nav">
                        <li >
                            <a href="/tasks" id="tasks">
                                <i class="fa fa-file-text icon">
                                    <b class="bg-primary"></b>
                                </i>
                                <span>Tasks</span>
                            </a>
                        </li>
                        <li >
                            <a href="/notes" id="notes">
                                <i class="fa fa-file-text icon">
                                    <b class="bg-info"></b>
                                </i>
                                <span>Notes</span>
                            </a>
                        </li>
                        <li >
                            <a href="/home" id="home">

                                <i class="fa fa-file-text icon">
                                    <b class="bg-primary dker"></b>
                                </i>
                                <span>Message</span>
                            </a>
                        </li>
                    </ul>
                </nav> <!-- / nav -->
            </div>
        </section>
    </section>
    <script>
        $(document).ready(function () {
            console.log(window.location.pathname)
            if(window.location.pathname == '/home'){
                $('#home').addClass('active')
            }
            if(window.location.pathname == '/tasks'){
                $('#tasks').addClass('active')
            }
            if(window.location.pathname == '/notes'){
                $('#notes').addClass('active')
            }
        });
    </script>
    @include('partials.users_nav')

    <footer class="footer lt hidden-xs b-t b-dark"> <div id="chat" class="dropup">
            <section class="dropdown-menu on aside-md m-l-n">
                <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                        <p class="text-sm">No active chats.</p>
                        <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                </section>
            </section>
        </div> <div id="invite" class="dropup">
            <section class="dropdown-menu on aside-md m-l-n">
                <section class="panel bg-white">
                    <header class="panel-heading b-b b-light"> <i class="fa fa-circle text-success"></i> </header>
                    <div class="panel-body animated fadeInRight">
                        <p class="text-sm">No</p>
                        <p>
                            <a href="#" class="btn btn-sm btn-facebook">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </p>
                    </div>
                </section>
            </section>
        </div>
        <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
            <i class="fa fa-angle-left text"></i>
            <i class="fa fa-angle-right text-active"></i>
        </a>
        <div class="btn-group hidden-nav-xs">
            <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#chat">
                <i class="fa fa-comment-o"></i>
            </button>
            <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#invite">
                <i class="fa fa-facebook"></i>
            </button>
        </div>
    </footer>
</aside>
<!-- /.aside -->