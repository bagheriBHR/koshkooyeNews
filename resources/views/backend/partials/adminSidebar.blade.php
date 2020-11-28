<div class="sidebar col-12 col-md-5 pr-md-0">
    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-info-circle ml-2"></i> اطلاعات پایه
        </a>
    </p>
    <div class="collapse show" id="collapseExample">
        <div class="card card-body mb-4 border-0 p-0">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-cog ml-2"></i>تنظیمات اولیه</td>
                    <td class="text-left py-2 font-weight-normal pl-3">
                        <a href="#" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        <a href="#"><i class="fas fa-eye ml-2"></i> مشاهد لیست</a>
                    </td>
                </tr>
                @can('viewAny',\Illuminate\Support\Facades\Auth::user())
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-users  ml-2"></i>کاربران</td>
                    <td class="text-left py-2 font-weight-normal pl-3">
                        <a href="{{route('user.create')}}" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        <a href="{{route('user.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده لیست</a>
                    </td>
                </tr>
                @endcan
            </table>
        </div>
    </div>

    <p>
        <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-newspaper  ml-2"></i>مدیریت اخبار
        </a>
    </p>
    <div class="collapse show" id="collapseExample2">
        <div class="card card-body mb-4 border-0 p-0">
            <table class="w-100 text-right">
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><i class="fas fa-th ml-2"></i> دسته بندی ها </td>
                    <td class="text-left py-2 font-weight-normal pl-3">
                        <a href="{{route('category.create')}}" class="pl-3"><i class="fa fa-plus ml-2"></i> اضافه کردن </a>
                        <a href="{{route('category.index')}}"><i class="fas fa-eye ml-2"></i> مشاهده</a>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="#"><i class="fas fa-utensils  ml-2"></i>برنامه غذایی کاربران</a></td>
                    <td class="text-left py-2 font-weight-normal pl-3">
                        <a href="#" class="pl-3"><img src="image/add.png" alt="" class="pl-1"> اضافه کردن </a>
                        <a href="#"><img src="image/edit.png" alt="" class="pl-1"> تغییر</a>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-weight-bold"><a href="#"><i class="fas fa-dumbbell  ml-2"></i>برنامه ورزشی کاربران</a></td>
                    <td class="text-left py-2 font-weight-normal pl-3">
                        <a href="#" class="pl-3"><img src="image/add.png" alt="" class="pl-1"> اضافه کردن </a>
                        <a href="#"><img src="image/edit.png" alt="" class="pl-1"> تغییر</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
