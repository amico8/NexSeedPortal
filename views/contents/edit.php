<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="row contact-row">
                    <div class="category col-sm-7 contact-right">
                    <form method="POST" id="contact-form" class="form-horizontal" action="edit_check.html">
                        <div class="btn-section dropdown01">
                            <select name="category" class="category">
                                <option value="category">カテゴリ</option>
                                <option value="restaurant" selected>レストラン</option>
                                <option value="shop">雑貨屋・お土産屋</option>
                                <option value="hobby">遊び</option>
                                <option value="life">生活用品</option>
                                <option value="beauty">ヘアサロン・スパ</option>
                            </select>
                        </div>
                        <div class="category">
                            <input type="text" name="storename" id="storename" class="form-control input-lg" placeholder="Store name" value="バリカタラーメン" required/>
                            <input type="text" name="location" id="location" class="form-control input-lg" placeholder="Location" required/>
                            <input type="file" name="Photo" placeholder="Photo" class="form-control input-lg" value="">
                        </div>
                        <div class="abc">
                            <span>Review:</span>
                            <p class="abc01">
                                <input type="radio" name="point" value="1">１
                                <input type="radio" name="point" value="2">２
                                <input type="radio" name="point" value="3" checked>３
                                <input type="radio" name="point" value="4">４
                                <input type="radio" name="point" value="5">５
                            </p>
                        </div>
                        <div class="category">
                            <textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message wow fadeInUp"  placeholder="Comment" required>懐かしい日本風ラーメンを食べられて良かったけど、値段が微妙。</textarea>
                        </div>
                        <div class="col-sm-4">
                            <a href=''>
                                <input type="button" name="button" value="Back" class="btn01 wow fadeInUp" />
                            </a>
                        </div>
                        <!-- 確認ボタン -->
                        <div class="col-sm-4 contact-left">
                            <input type="submit" name="submit" value="Edit" class="btn wow fadeInUp" />
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>