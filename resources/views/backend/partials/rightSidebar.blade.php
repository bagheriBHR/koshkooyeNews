<div class="has-sidebar h-100 mb-2 mb-md-0">
    <!-- right sidebar -->
    <div class="right-sidebar d-flex flex-column w-100">
        <div class="d-flex flex-column justify-content-between menu text-right">
            <div class="w-100">
                <a class="mb-2 sidebarItem text-right d-flex align-items-center" href="{{route('admin.home')}}"><i class="fas fa-home ml-2"></i>داشبورد</a>
                @can('viewAny',\Illuminate\Support\Facades\Auth::user())
                    <p class="mb-0">
                        <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample10" aria-expanded="false" aria-controls="collapseExample">
                            <span class="d-flex align-items-center"><i class="fa fa-users ml-3"></i>مدیریت کاربران</span>
                            <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample10">
                        <div class="border-0 p-0">
                            <table class="w-100 text-right">
                                <tr>
                                    <td class="py-2 pr-2"><a href="{{route('user.index')}}" class="d-flex align-items-center"><i class="fas fa-eye ml-2"></i>  مشاهده لیست کاربران </a></td>
                                </tr>
                                @can('create',\Illuminate\Support\Facades\Auth::user())
                                    <tr>
                                        <td class="py-2 pr-2"><a href="{{route('user.create')}}" class="d-flex align-items-center"><i class="fa fa-user-plus ml-2"></i>افزودن کاربر</a></td>
                                    </tr>
                                @endcan
                            </table>
                        </div>
                    </div>
                @endcan
                <p class="mb-0">
                    <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample11" aria-expanded="false" aria-controls="collapseExample">
                        <span class="d-flex align-items-center"><i class="fas fa-newspaper  ml-2"></i>مدیریت مقالات</span>
                        <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                    </a>
                </p>
                <div class="collapse in" id="collapseExample11">
                    <div class="border-0 p-0">
                        <table class="w-100 text-right">
                            <tr>
                                <td class="py-2 pr-2"><a href="{{route('article.index')}}" class="d-flex align-items-center"><i class="fas fa-eye ml-2"></i>  مشاهده لیست مقالات </a></td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-2"><a href="{{route('article.create')}}" class="d-flex align-items-center"><i class="fa fa-plus ml-2"></i>افزودن مقاله</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <p class="mb-0">
                    <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample12" aria-expanded="false" aria-controls="collapseExample">
                        <span class="d-flex align-items-center"><i class="fas fa-th ml-2"></i>مدیریت دسته بندی ها</span>
                        <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                    </a>
                </p>
                <div class="collapse in" id="collapseExample12">
                    <div class="border-0 p-0">
                        <table class="w-100 text-right">
                            <tr>
                                <td class="py-2 pr-2"><a href="{{route('category.index')}}" class="d-flex align-items-center"><i class="fas fa-eye ml-2"></i>  مشاهده لیست دسته بندی </a></td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-2"><a href="{{route('category.create')}}" class="d-flex align-items-center"><i class="fa fa-plus ml-2"></i>افزودن دسته بندی</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                @can('create',\Illuminate\Support\Facades\Auth::user())
                <p class="mb-0">
                    <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample13" aria-expanded="false" aria-controls="collapseExample">
                        <span class="d-flex align-items-center"><i class="fas fa-ad ml-2"></i>مدیریت تبلیغات</span>
                        <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                    </a>
                </p>
                <div class="collapse in" id="collapseExample13">
                    <div class="border-0 p-0">
                        <table class="w-100 text-right">
                            <tr>
                                <td class="py-2 pr-2"><a href="{{route('commercial.index')}}" class="d-flex align-items-center"><i class="fas fa-eye ml-2"></i>  مشاهده لیست تبلیغات</a></td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-2"><a href="{{route('commercial.create')}}" class="d-flex align-items-center"><i class="fa fa-plus ml-2"></i>افزودن تبلیغات</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endcan
                <a class="sidebarItem text-right d-flex align-items-center" href="{{route('tag.index')}}"><i class="fas fa-tags ml-2"></i>تگ ها</a>
            </div>

            @can('update',\Illuminate\Support\Facades\Auth::user())
                <a class="sidebarItem text-right d-flex align-items-center" href="{{route('setting.index')}}"><i class="fas fa-cog ml-2"></i>تنظیمات اولیه</a>
            @endcan
        </div>
    </div>
    <!-- end of right sidebar -->

</div>
