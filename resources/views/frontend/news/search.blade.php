@extends('frontend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/persianDatepicker-default.css')}}">
@endsection
@section('content')
    <div class="px-2 px-md-5 mt-3 searchPage">
        <form action="{{route('home')}}" method="GET" role="search" class="w-100 d-flex flex-column justify-content-center" autocomplete="off">
            <div class="d-flex flex-column flex-md-row mb-2">
                <input hidden value="advance">
                <input type="text" value="{{isset($tag) ? $tag->name : ''}}" placeholder="عبارت مورد نظر را وارد کنید..." name="q" class="custom-field form-control col-12 col-md-11">
                <button type="submit" class=" d-none d-md-block col btn btn-filter mb-0 px-4 mr-0 mr-md-2">فیلتر</button>
            </div>
            <div class="w-100 d-flex flex-column flex-md-row">
                <div class="col-md-3 px-0 custom-select">
                    <select name="service">
                        <option value="">سرویس خبر</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 px-0 custom-select mr-0 mr-md-4">
                    <select name="type">
                        <option value="">نوع خبر</option>
                        <option value="0">متن</option>
                        <option value="1">عکس</option>
                        <option value="2">ویدیو</option>
                        <option value="3">صوت</option>
                    </select>
                </div>
                <div  class="col px-0 form-group mb-1 mr-0 mr-md-4">
                    <input type="text" class="h-100 custom-field form-control form-control-sm pr-3" id="input2" placeholder="از تاریخ" name="from" />
                    <span id="span2"></span>
                </div>
                <div  class="col px-0 form-group mb-1 mr-0 mr-md-4">
                    <input type="text" class="h-100 custom-field form-control pr-3" id="input1" placeholder="تا تاریخ" name="end" />
                    <span id="span1"></span>
                </div>
                <button type="submit" class="d-block d-md-none col btn btn-filter mt-2 mb-0 px-4 mr-0 mr-md-2">فیلتر</button>

            </div>
        </form>
    </div>

    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main my-3">
        <div class="col-12 d-flex flex-column px-0 pl-md-2">
        @if(!($articles->isEmpty()))
            <!-- carousel -->
            <div class="d-flex flex-wrap">
                @foreach($articles as $article)
                    <div class="col-12 px-0 category-item mt-3 mx-md-1">
                        <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}" class="d-flex flex-wrap p-2">
                            <div class="col-12 col-md-3 px-0 position-relative">
                                @if($article->type==1)
                                    <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-camera"></i></div>
                                @elseif($article->type==2)
                                    <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-film"></i></div>
                                @endif
                                <img src="{{'/storage'.$article->photo->path.'medium_'.$article->photo->originalName }}" alt="{{$article->title}}" class="w-100 h-100">
                            </div>
                            <div class="col-12 col-md-9 d-flex flex-column justify-content-center pl-1">
                                <h3 class="roo-titr mt-3">لورم ایپسوم یا طرح‌نما :</h3>
                                <h2 class="mt-1 mt-md-1">{{$article->title}}</h2>
                                <div>{!! \Illuminate\Support\Str::limit($article->body,350) !!}</div>
                                <span>{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($article->publish_date)->format(' %d %B، %Y') ) }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="w-100 mt-3 d-flex justify-content-center">{{$articles->links()}}</div>
            </div>
        @endif
        </div>
    </div>
    <!-- end of body -->
@endsection
@section('script')
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="{{asset('backend/js/persianDatepicker.min.js')}}"></script>
    <script>

        $(function() {
            $("#input1, #span1").persianDatepicker();
            $("#input2, #span2").persianDatepicker();
        });

        // custom select--------------------------------------------------------------------
        var x, i, j, l, ll, selElmnt, a, b, c;
        /* Look for any elements with the class "custom-select": */
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /* For each element, create a new DIV that will act as the selected item: */
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /* For each element, create a new DIV that will contain the option list: */
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                /* For each option in the original select element,
                create a new DIV that will act as an option item: */
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function (e) {
                    /* When an item is clicked, update the original select box,
                    and the selected item: */
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function (e) {
                /* When the select box is clicked, close any other select boxes,
                and open/close the current select box: */
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /* A function that will close all select boxes in the document,
            except the current select box: */
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }

        document.addEventListener("click", closeAllSelect);/*  clicks anywhere outside, close all select boxes: */
    </script>
@endsection
