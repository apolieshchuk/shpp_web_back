# Create table authors
CREATE TABLE IF NOT EXISTS Authors(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(255) UNIQUE NOT NULL
);

# Insert authors from table books in table authors
INSERT IGNORE INTO Authors (authors) SELECT authors FROM Books;

# Create table book_authors
CREATE TABLE IF NOT EXISTS BookWithAuthor(
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      bookId INT(6) UNIQUE NOT NULL,
      authorId INT(6) DEFAULT 0
);

# Create books id
INSERT IGNORE INTO BookWithAuthor (bookId) SELECT id FROM Books;

# Connect books id to author id