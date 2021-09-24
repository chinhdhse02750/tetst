<div class="form-group row flex-group">
    <div class="col-md-12">
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label for="name" class="col-md-2 form-control-label ">
                        Tên sản phẩm :
                    </label>
                    <div class="col-md-5">
                        <input type="text" id="name" placeholder="Name" name="name" required
                               maxlength="255" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-2 form-control-label">Trạng thái</label>
                    <div class="col-md-10 pt-7px">
                        <input type="radio" class="radio pdr-5" name="status" value="1"
                               id="release"
                               checked/>
                        <label for="release"
                               class="pr-20px">Hiển thị</label>
                        <input type="radio" class="radio" name="status" value="0" id="private"/>
                        <label for="private"
                               class="pr-20px">ẩn</label>

                    </div><!--col-->
                </div>
            </div>
        </div> <!-- /form -->
    </div>
</div><!--row-->
