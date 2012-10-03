<?php

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
      return $this->getTitle().' by '.$this->getAuthor();
    }
}

class BookTitleDecorator {
    protected $book;
    protected $title;
    public function __construct(Book $book_in) {
        $this->book = $book_in;
        $this->resetTitle();
    }	
 
    function resetTitle() {
        $this->title = $this->book->getTitle();
    }
    function showTitle() {
        return $this->title;
    }
}

class BookTitleExclaimDecorator extends BookTitleDecorator {
    private $btd;
    public function __construct(BookTitleDecorator $btd_in) {
        $this->btd = $btd_in;
    }
    function exclaimTitle() {
        $this->btd->title = "!" . $this->btd->title . "!";
    }
}

class BookTitleStarDecorator extends BookTitleDecorator {
    private $btd;
    public function __construct(BookTitleDecorator $btd_in) {
        $this->btd = $btd_in;
    }
    function starTitle() {
        $this->btd->title = Str_replace(" ","*",$this->btd->title);
    }
}

  $patternBook = new Book('Book of Stuff', 'Hachey');
 
  $decorator = new BookTitleDecorator($patternBook);
  $starDecorator = new BookTitleStarDecorator($decorator);
  $exclaimDecorator = new BookTitleExclaimDecorator($decorator);
 
  writeln('Showing Title : ');
  writeln($decorator->showTitle());
  writeln('');
 
  writeln('Showing title after two exclaims added : ');
  $exclaimDecorator->exclaimTitle();
  $exclaimDecorator->exclaimTitle();
  writeln($decorator->showTitle());
  writeln('');
 
  writeln('Showing title after star added : ');
  $starDecorator->starTitle();
  writeln($decorator->showTitle());
  writeln('');
 
  writeln('showing title after reset: ');
  writeln($decorator->resetTitle());
  writeln($decorator->showTitle());
  writeln('');

  function writeln($line_in) {
    echo $line_in."<br/>";
  }

?>