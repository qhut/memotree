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
                            <a href="#" id="home">

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
        @include('partials.users_nav')
    </section>
</aside>
<!-- /.aside -->