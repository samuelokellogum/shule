<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Shule</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{ route('userImage',['filename' => Session::get('userimage')])}}" alt="..." class="img-circle profile_img" style="width: 60px;height: 60px">
              </div>
              <div class="profile_info">
                  <span>Welcome,</span>
                <h2><?php echo Session::get('username') ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                  <h3 style="font-size: 18px">{{ Session::get('usergoup') }}</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Dashboard</a></li>
                    </ul>
                  </li>
                    @if(isset($userMenu))
                        <?php $obj = json_decode($userMenu); ?>
                        @foreach($obj as $row)
                                <li><a><i class="fa fa-bars"></i> {{ $row->menuname }} <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        @foreach($row->submenus as $row2)
                                            <li><a href="{{ $row2->slink }}">{{ $row2->sname }}</a></li>
                                            @endforeach
                                    </ul>
                                </li>
                            @endforeach
                    @endif
                    <li><a><i class="fa fa-bars"></i> Student <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('viewStudents') }}">Students</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-automobile"></i> Developer <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('devView') }}">Developer view</a></li>
                            <li><a href="{{ route('menuView') }}">Menu</a></li>
                        </ul>
                    </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>