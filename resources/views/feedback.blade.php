<div class="form-group">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3" style="color: white">
                            <h2 class="text-center" style="letter-spacing: 5px">feedback</h2>
                            <div>
                                <p style="font-size: 11px;color: whitesmoke;"><i class="fas fa-sms" style="margin-right: 3px"></i>Phone:0947781266</p>
                                <p style="font-size: 11px;color: whitesmoke"><i class="fas fa-envelope" style="margin-right: 3px"></i>Email:checkpassnch@gmail.com</p>
                            </div>
                            <form method="post" action="{{route('test_email')}}">
@csrf
<input class="col-sm-6 form-control" type="text" placeholder="Name" name="name" style="margin-bottom: 10px">
<input class="col-sm-6 form-control" type="email" placeholder="Email" name="email" style="margin-bottom: 10px">
<textarea style="color: black !important;" name="comment" rows="10" cols="30"></textarea>
<input type="submit" class="btn btn-primary" name="submit" value="send" >

</form>
</div>
</div>
</div>
