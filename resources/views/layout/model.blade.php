<div class="modal fade" style=" position:fixed;" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(to left,#4facfe  0%,#00f2fe  100%) !important;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color: black;  margin-left:200px;"> Ask Question</h5>
                <button type="button" style="outline: none;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="modal-form" action="{{ url('/') }}/data" name="myForm" onsubmit="return validateForm()" method="post">
                    @csrf
                    <div class="form-group">
                        {{-- <div class="form-group" style="border: 2px solid red;"> --}}

                            {{-- <div style="border: 2px solid black;height:100px;" class="col-form-label"> --}}
                               <label for="message-text"><h5>Category</h5></label>
                            {{-- </div> --}}

                            {{-- <div style="border: 2px solid green; margin-top:0px;"class="col-75"> --}}
                                <select id="require" name="category">
                                    <option value="">select your Category</option>
                                    <option name=" ">Technology</option>
                                    <option name=" ">Stocks</option>
                                    <option name=" ">Networking </option>
                                    <option name=" ">Fashion </option>
                                    <option name=" ">Cryptocurrency</option>
                                    <option name=" ">Defence </option>
                                    <option name=" ">Education</option>
                                    <option name=" ">Sports</option>

                                </select>
                            {{-- </div> --}}
                            <div style="color:red;" id="error"></div>
                        {{-- </div> --}}
                            <br><br>
                        {{-- <div style="border: 2px solid rgb(0, 81, 255);"class="form-group" > --}}
                            <label for="message-text" class="col-form-label"><h5>Add Question :</h5></label>
                            <textarea style="height:100px;" class="form-control" name="des" placeholder="Start your Question with ' What ',' How ',' Why ' ect." id="desc"></textarea>
                            <div style="color:red;" id="err"></div>
                        {{-- </div> --}}

                            <br>
                        <div class="modal-footer">
                            <button type="button" id="dismissModelBtn" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>