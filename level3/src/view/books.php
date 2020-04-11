<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php foreach ($data as $book): ?>
                <div data-book-id="<?php echo $book['id'] ?>"
                     class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="/books/book/?id=<?php echo $book['id'] ?>"><img src="/assets/books-preview/<?php echo $book['preview']?>" alt="<?php echo $book['book']?>">
                            <div data-title="<?php echo $book['book']?>" class="blockI" style="height: 46px;">
                                <div data-book-title="<?php echo $book['book']?>" class="title size_text"><?php echo $book['book']?></div>
                                <div data-book-author=""<?php echo $book['authors']?>" class="author"><?php echo $book['authors']?></div>
                            </div>
                        </a>
                        <a href="/books/book/?id=<?php echo $book['id'] ?>">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
            <? endforeach; ?>

    <center>оопс... в этом хтмл не реализованы кнопки "вперед" и "назад", а книг на странице должно быть не больше 20</center>

</section>
