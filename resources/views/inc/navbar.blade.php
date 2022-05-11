<nav id="sidebar">
    <div class="sidebar-header">
        @guest
            <h3>Skripsi</h3>
        @else
        @if (Auth::user()->role == '1')
            @php
                $portofolio = App\Portofolio::where('user_id' , Auth::user()->id)->get();
                try {
                    $image = $portofolio[0]->profile_image;
                } catch (\Throwable $th) {
                    $image = 'user_dummy.jpg';
                }
            @endphp
        @endif
        @if (Auth::user()->role == '2')
            @php
                $company = App\Company::where('user_id' , Auth::user()->id)->get();
                try {
                    $image = $company[0]->logo;
                } catch (\Throwable $th) {
                    $image = 'user_dummy.jpg';
                }
            @endphp
        @endif
            <img src="/storage/img/{{$image}}" class="rounded-circle img-fluid" style="width: 120px"/>

            <h4>
                {{ Auth::user()->name }}
            </h4>
            <span>
                <h6>
                    @if (Auth::user()->role == '1')
                        Applicant
                        @php
                            $id = Auth::user()->id;
                            $portofolio = App\Portofolio::where('user_id' , $id)->get();
                        @endphp
                        @if (count($portofolio) == 0)
                            <a href="/portofolio/create" class="btn btn-dark btn-sm">
                                View Profile
                            </a>
                        @else
                            <a href="/portofolio/{{ $id }}" class="btn btn-dark btn-sm">
                                View Profile
                            </a>
                        @endif
                    @endif
                    @if (Auth::user()->role == '2')
                        Company
                        @php
                            $id = Auth::user()->id;
                            $company = App\Company::where('user_id' , $id)->get();
                        @endphp
                        @if (count($company) == 0)
                            <a href="/company/create" class="btn btn-dark btn-sm">
                                View Profile
                            </a>
                        @else
                            <a href="/company/{{ $id }}" class="btn btn-dark btn-sm">
                                View Profile
                            </a>
                        @endif
                    @endif
                    @if (Auth::user()->role == '0')
                        Administrator
                    @endif
                </h6>
            </span>
        @endguest

    </div>

    <ul class="list-unstyled components">
        {{-- <p>Dummy Heading</p> --}}
        {{-- <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
            </ul>
        </li> --}}
        @guest
            @if(Route::has('register'))
                <li>
                    <a class="nav-link"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            <li >
                <a class="nav-link" href="/login">{{ __('Login') }}</a>
            </li>
        @else
            @if (Auth::user()->role == '1')
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="#">My Job Applied</a>
                </li>
                <li>
                    <a href="#">Inbox</a>
                </li>
                <li>
                    <a href="#">Reporting</a>
                </li>
            @endif

            @if (Auth::user()->role == '2')

                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Vacancies</a>
                </li>
                <li>
                    <a href="#">Request Verify Account</a>
                </li>

            @endif

            @if (Auth::user()->role == '0')

                <li>
                    <a href="#">Validate Job Vacancy</a>
                </li>
                <li>
                    <a href="#">View Applicant's Report</a>
                </li>
                <li>
                    <a href="#">Verify Company Profile</a>
                </li>

            @endif



            <li >
                <a  href="#">
                    {{-- {{ Auth::user()->name }} --}}
                    Settings
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>

            </li>
        @endguest

        {{-- <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
            </ul>
        </li> --}}
    </ul>



    {{-- <ul class="list-unstyled CTAs">
        @guest
            @if(Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/login">{{ __('Login') }}</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

    </ul> --}}
</nav>
