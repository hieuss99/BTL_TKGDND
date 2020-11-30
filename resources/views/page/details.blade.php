@extends('page.master')
@section('title')
    Chi tiết sản phẩm
@stop
@section('css')
<style>
    .pagination {
        margin: 10px 112px;
    }
</style>
@stop
@section('content')
    <div class="container-fluid" style="padding: 15px; background: whitesmoke;">
        <div  style="margin-top: 5px;"><!--class="row"-->
            <div class="col-sm-3" style=" padding: 0px;margin-top: 20px">
                <ul class="list-group" style="width: 400px;margin-left: 20px">
                    @foreach($type_product as $sp)
                        @if($sp->id != $product[0]['id'])
                            <li  class="list-group-item" style="background-color: white; height: 110px">

                                <div class="single-item-header" style="height: 80px; width: 80px; display: inline-block; float: left;margin-top: 7px">
                                    <a href="{{route('details',[$sp->id_type,$sp->id])}}">
                                        <img style="height: 80px;width: 80px"  class="img-circle" src="/img/product/{{$sp->image}}" alt="">
                                    </a>
                                </div>
                                <div class="body" style="height: 100%; width: 200px; display: inline-block; margin-left: 60px;margin-top: -5px">
                                    <p class="single-item-title" style="color: #31b0d5 !important;letter-spacing: 2px;">{{$sp->name}}</p>
                                    <p class="price ">
                                        @if($sp->promotion_price != 0)
                                            <span style="text-decoration: line-through">{{number_format($sp->unit_price)}} đồng</span>
                                            <span  style="color: orange;margin-bottom: 10px">{{number_format($sp->promotion_price)}} đồng</span>
                                        @else
                                                <span class="form-inline">{{number_format($sp->unit_price)}} đồng</span>
                                        @endif
                                    </p>
                                    <a class="shopping shop" style="background: whitesmoke" href="{{route('cart',$sp->id)}}"><i class="fas fa-cart-plus"></i></a>

                                    <a class="shopping pay"  style="background: whitesmoke" href="{{route('details',[$sp->id_type,$sp->id])}}">Chi tiết<i class="fa fa-chevron-right"></i></a>

                                </div>
                                <div class="caption" style="margin-top: 10px">

                                </div>


                            </li>
                        @endif
                    @endforeach
                    <div style="margin-top: 30px">
                        {{$type_product->links()}}
                    </div>
                </ul>
            </div>
            <div class="col-sm-8" style="background-color: whitesmoke;padding: 45px; ">
                <div class="col-sm-4" style="margin-top: -20px;margin-left: 10%">
                    <div class="single-item-header">
                        <a href="#"><img style="height: 300px;width: 400px"  class="img-fluid" src="/img/product/{{$product[0]['image']}}" alt=""></a>
                    </div>
                </div>
                <div class="col-sm-4" style="margin-left: 22%;margin-top: -20px">
                    <p class="single-item-title" style="letter-spacing: 5px; font-size: medium;color: #31b0d5">{{$product[0]['name']}}</p>

                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $star)
                            <i class="fas fa-star" style="display: inline-block; color : #ffd655"></i>
                        @else
                            <i class="far fa-star" style="display: inline-block; color : #b3b8b5"></i>
                        @endif
                    @endfor

                    @if($sp->promotion_price != 0)
                        <span style="text-decoration: line-through">{{number_format($product[0]['unit_price'])}} đồng</span>
                        <span  style="color: orange;margin-bottom: 10px">{{number_format($product[0]['promotion_price'])}} đồng</span>

                    @else
                        <p class="price" style="height: 32px; padding-top: 8px">
                            <span class="form-inline" style="font-size: medium">{{number_format($product[0]['unit_price'])}} đồng</span>
                        </p>
                    @endif
                    <div class="descreption blockquote">
                        {{$product[0]['description']}}
                    </div>
                    <div class="caption" style="margin-top: 30px;margin-left: 0px">
                        <a class="shopping shop"  href="{{route('cart',$product[0]['id'])}}"><i class="fas fa-cart-plus"></i></a>
                        <a class="shopping" href="{{route('don_hang')}}" style="letter-spacing: 2px"><i class="fas fa-mouse-pointer"></i>Thanh toán</a>

                    </div>

                </div>
                <div class="col-sm-12" style="top: 45px; padding-top: 15px; padding-bottom: 15px; height: 100%;background-color: whitesmoke;">
                    <div style="height: 35px;margin-left: 10%;margin-top:-20px ">
                        <p style="display: inline-block; font-size: large; margin-top: 12px">NHẬN XÉT</p>
                        @if ($auth_rate != null)
                            <button class="btn btn-primary" style="float: right; " onclick="showHideForm()">Viết đánh giá</button>
                        @endif
                    </div>
                    @if ($auth_rate != null)
                        <div id="rate-form" style="display: {{session('rateError') ? "block" : "none"}}; height: 230px; padding-top: 15px">
                            <form method="POST" action="{{route('postReview')}}" style="height: 215px;margin-left: 10%; alignment: center; background: lightskyblue; box-shadow: 3px 5px #c3c3c3;">
                                @csrf
                                <div id='stars' style="padding-top: 10px" onmouseout="bright()" >
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="far fa-star" onmouseover="bright({{$i + 1}})" onclick="{
                                            document.getElementsByName('rate_input')[0].getAttributeNode('value').value = '{{$i + 1}}'
                                            }" style="display: inline-block; color : #b3b8b5"></i>
                                    @endfor
                                </div>
                                <input readonly name="product_id" style="display: none" type="number" value="{{$auth_rate['product_id']}}">
                                <input readonly name="customer_id" style="display: none" type="number" value="{{$auth_rate['customer_id']}}">
                                <input readonly name="rate_input" style="display: none" type="number" value="{{$auth_rate['rate']}}">
                                <textarea class="form-control" rows="5" name="content_input" placeholder="Nhận xét của bạn" maxlength=900>{{$auth_rate['content']}}</textarea>
                                <div style="display: block; height: 44px;">
                                    <button class="btn btn-default" style="display: inline-block; float: right; margin: 5px" type="reset" onclick="showHideForm()">HỦY</button>
                                    <button class="btn btn-success" style="display: inline-block; float: right; margin: 5px" type="submit">GỬI</button>
                                    <span style="height: 44px; display: inline; color: red; ">{{session('rateError')}}</span>
                                </div>
                            </form>
                        </div>
                    @endif
                    <br>

                    <div id="customer-rates" style="display: block; padding: 0px 15px 0px 15px; alignment: center; background: white;margin-left: 10%">
                        @for ($j = 0; $j < count($rates); $j++)
                            <div style="border-bottom: .1rem dashed lightgray; padding: 15px 0px 5px 0px; display:{{$j < 5 ? "block" : "none"}}">
                                <p style="display: inline; word-wrap:break-word; color: dodgerblue; font-weight: bold">{{$rates[$j]->customer_name}}: </p>
                                <div style="float: right;">
                                    @for ($i = 0; $i < 5; $i++)

                                        @if($i < $rates[$j]->rate)
                                            <i class="fas fa-star" style="display: inline-block; color : #ffd655"></i>
                                        @else
                                            <i class="far fa-star" style="display: inline-block; color : #b3b8b5"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div style="min-height: 20px; display: block; overflow: hidden; -webkit-box-orient: vertical; word-wrap:break-word;">
                                    {{substr($rates[$j]->content, 0, 400)}}@if(strlen($rates[$j]->content) > 400)<span style="display: inline;">...</span><span style="display: none;">{{substr($rates[$j]->content, 400)}}</span>
                                    <a class="seeAll" style="color: green; text-decoration: none; outline: none; " role="button"> xem hết</a>
                                    @endif
                                </div>
                            </div>
                        @endfor
                        @if (count($rates) > 5)
                            <a id="see-more-button" style="display: block; text-align: center; color: yellowgreen" role="button" onclick="renderMoreRates()">Xem thêm</a>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>
@stop
@section('script')
    <script>
        @if(session('success'))
        alert('Cảm ơn vì feedback từ bạn , chúng tối sẽ phản hồi sớm nhất');
        @endif
        @if(session('empty'))
        alert('Mặt hàng này hiện chưa có, vui lòng quay lại sau');
        @endif
        $(document).ready(function(){

            $(".shop").click(function () {

            });
            $(".shop").mouseenter(function(){
                $(this).css('background','orange');
            });
            $(".shop").mouseleave(function () {
                $(this).css('background','whitesmoke')
            });
            $(".pay").mouseenter(function(){

                $(this).css('background','#1b6d85');
            });
            $(".pay").mouseleave(function () {
                $(this).css('background','whitesmoke')
            });

            $(".seeAll").click(function(){
                if($(this).text() === " xem hết") {
                    $(this).html(" rút gọn");
                } else {
                    $(this).html(" xem hết");
                }
                $(this).prev().prev().toggle();
                $(this).prev().toggle();
                return false;
            });
        });

        @if ($auth_rate != null)
            function showHideForm() {
                let x = document.getElementById("rate-form");

                if (x.style.display === "none") {
                    document.getElementsByName("rate_input")[0].getAttributeNode("value").value = "{{$auth_rate['rate']}}";
                    document.getElementsByName("content_input")[0].textContent = "{{$auth_rate['content']}}";
                    bright();
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        @endif

        function bright(num) {
            if (num == null)
                num = document.getElementsByName("rate_input")[0].getAttributeNode("value").value;
            let iArr = document.getElementById("stars").childNodes;
            for(let i=1; i <= 10; i += 2) {
                if(i < num*2 + 1) {
                    iArr[i].className = "fas fa-star";
                    iArr[i].style.color = "#ffd655";
                }else {
                    iArr[i].className = "far fa-star";
                    iArr[i].style.color = "#b3b8b5";
                }
            }
        }
        function renderMoreRates() {
            let rateArr = document.getElementById("customer-rates").childNodes;
            let maxLength = (rateArr.length - 3) / 2;
            let st = 0;
            for (let i = 0; i < maxLength; i++){
                if (rateArr[i*2+1].style.display === "none") {
                    st = i;
                    break;
                }
            }
            for (let i = st; i < st+5 && i < maxLength; i++){
                rateArr[i*2+1].style.display = "block";
            }
            if (st + 5 >= maxLength){
                document.getElementById("see-more-button").style.display = "none";
            }
        }
    </script>
@stop
