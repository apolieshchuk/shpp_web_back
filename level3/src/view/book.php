<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="book_block col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <script id="pattern" type="text/template">
                <div data-book-id="{id}" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="/book/{id}"><img src="img/books/{id}.jpg" alt="{title}">
                            <div data-title="{title}" class="blockI">
                                <div data-book-title="{title}" class="title size_text">{title}</div>
                                <div data-book-author="{author}" class="author">{author}</div>
                            </div>
                        </a>
                        <a href="/book/{id}">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
            </script>
            <div id="id" book-id="<?php echo $data['id'] ?>">
                <div id="bookImg" class="col-xs-12 col-sm-3 col-md-3 item" style="
    margin:;
"><img src="/assets/books-preview/<?php echo $data['preview'] ?>" alt="Responsive image" class="img-responsive">

                    <hr>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 info">
                    <div class="bookInfo col-md-12">
                        <div id="title" class="titleBook"><?php echo $data['book'] ?></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="bookLastInfo">
                            <div class="bookRow"><span class="properties">автор: </span><span id="author"><?php echo $data['authors'] ?></span></div>
                            <div class="bookRow"><span class="properties">год: </span><span id="year"><?php echo $data['year'] ?></span></div>
                            <div class="bookRow"><span class="properties">страниц: </span><span id="pages">999</span></div>
                            <div class="bookRow"><span class="properties">isbn: </span><span id="isbn"></span></div>
                        </div>
                    </div>
                    <div class="btnBlock col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btnBookID btn-lg btn btn-success">Хочу читать!</button>
                    </div>
                    <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-sm">
                        <h4>О книге</h4>
                        <hr>
                        <p id="description">Some Description</p>
                    </div>
                </div>
                <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-md hidden-lg">
                    <h4>О книге</h4>
                    <hr>
                    <p class="description">Some Description 2</p>
                </div>
            </div>
            <script src="/assets/book-page/book-page_files/book.js" defer=""></script>
        </div>
    </div>
</section>
<section id="footer" class="footer-wrapper">
    <div class="navbar-bottom row-fluid">
        <div class="navbar-inner">
            <div class="container-fuild">
                <div class="content_footer"> Made with<a href="http://programming.kr.ua/" class="heart"><i aria-hidden="true" class="fa fa-heart"></i></a>by HolaTeam</div>
            </div>
        </div>
    </div>
</section>