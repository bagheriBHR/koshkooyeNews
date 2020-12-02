<div class="sidebar col-12 col-md-5 pr-md-0">
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-info-circle ml-2"></i> اطلاعات پایه
        </a>
    </p>
    <div class="collapse show" id="collapseExample">
        <div class="card card-body mb-4 border-0 p-0">
            <table class="w-100 text-right">
                @can('update',\Illuminate\Support\Facades\Auth::user())
                    <tr>
                        <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-cog ml-2"></i>تنظیمات اولیه</td>

                            <td class="d-flex justify-content-end py-2 font-weight-normal pl-3">
                                <a class="d-flex align-items-center" href="{{route('setting.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                            </td>
                    </tr>
                @endcan
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-th ml-2"></i> دسته بندی ها </td>
                    <td class="d-flex justify-content-end py-2 font-weight-normal pl-3">
                        <a class="d-flex align-items-center ml-4" href="{{route('category.create')}}" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        <a class="d-flex align-items-center" href="{{route('category.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @can('viewAny',\Illuminate\Support\Facades\Auth::user())
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-users  ml-2"></i>مدیریت کاربران
        </a>
    </p>
    <div class="collapse show" id="collapseExample2">
        <div class="card card-body mb-4 border-0 p-0">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-users  ml-2"></i>کاربران</td>
                    <td class="d-flex justify-content-end py-2 font-weight-normal pl-3">
                        @can('create',\Illuminate\Support\Facades\Auth::user())
                            <a class="d-flex align-items-center ml-4" href="{{route('user.create')}}" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        @endcan
                        <a class="d-flex align-items-center" href="{{route('user.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @endcan
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-newspaper  ml-2"></i>مدیریت مقالات
        </a>
    </p>
    <div class="collapse show" id="collapseExample3">
        <div class="card card-body mb-4 border-0 p-0">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-newspaper ml-2"></i>مقالات </td>
                    <td class="d-flex justify-content-end py-2 font-weight-normal pl-3">
                        <a class="d-flex align-items-center ml-4" href="{{route('article.create')}}" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        <a class="d-flex align-items-center" href="{{route('article.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-tags ml-2"></i>تگ ها </td>
                    <td class="d-flex justify-content-end py-2 font-weight-normal pl-3">
                        <a class="d-flex align-items-center" href="{{route('tag.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @can('create',\Illuminate\Support\Facades\Auth::user())
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-add  ml-2"></i>مدیریت تبلیغات
        </a>
    </p>
    <div class="collapse show" id="collapseExample4">
        <div class="card card-body mb-4 border-0 p-0">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-ad ml-2"></i>تبلیغات </td>
                    <td class="d-flex justify-content-end py-2 font-weight-normal pl-3">
                        <a class="d-flex align-items-center ml-4" href="{{route('commercial.create')}}" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        <a class="d-flex align-items-center" href="{{route('commercial.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @endcan
</div>
