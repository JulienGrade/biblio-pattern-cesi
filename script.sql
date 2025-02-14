-- Script SQL pour créer la base de données, les tables et insérer des données de test

-- Crée la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS `cesi-books`;
USE `cesi-books`;

-- Crée la table `books`
CREATE TABLE IF NOT EXISTS `books` (
                                       `id` INT AUTO_INCREMENT PRIMARY KEY,
                                       `title` VARCHAR(255) NOT NULL,
                                       `author` VARCHAR(255) NOT NULL,
                                       `category` VARCHAR(255) NOT NULL,
                                       `isbn` VARCHAR(13) NOT NULL
);

-- Insère des données de test dans la table `books`
INSERT INTO `books` (`title`, `author`, `category`, `isbn`) VALUES
                                                                ('Clean Code', 'Robert C. Martin', 'Programming', '9780132350884'),
                                                                ('Design Patterns', 'Erich Gamma', 'Programming', '9780201633610'),
                                                                ('Refactoring', 'Martin Fowler', 'Programming', '9780201485677'),
                                                                ('The Pragmatic Programmer', 'Andrew Hunt', 'Programming', '9780201616224'),
                                                                ('Effective Java', 'Joshua Bloch', 'Programming', '9780134685991'),
                                                                ('Thinking, Fast and Slow', 'Daniel Kahneman', 'Psychology', '9780374533557'),
                                                                ('Atomic Habits', 'James Clear', 'Self-Improvement', '9780735211292'),
                                                                ('Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'History', '9780062316097'),
                                                                ('Dune', 'Frank Herbert', 'Fiction', '9780441013593'),
                                                                ('The Lean Startup', 'Eric Ries', 'Business', '9780307887894');

-- Crée la table `members`
CREATE TABLE IF NOT EXISTS `members` (
                                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                                         `name` VARCHAR(255) NOT NULL,
                                         `address` VARCHAR(255) NOT NULL,
                                         `member_type` ENUM('student', 'teacher', 'staff') NOT NULL DEFAULT 'student'
);

-- Insère des données de test dans la table `members`
INSERT INTO `members` (`name`, `address`, `member_type`) VALUES
                                                             ('John Doe', '123 Main St', 'student'),
                                                             ('Jane Smith', '456 Elm St', 'teacher'),
                                                             ('Alice Johnson', '789 Maple Ave', 'staff'),
                                                             ('Bob Williams', '101 Oak St', 'student'),
                                                             ('Charlie Brown', '222 Pine St', 'teacher'),
                                                             ('David Wilson', '333 Cedar St', 'staff'),
                                                             ('Emily Davis', '444 Birch St', 'student'),
                                                             ('Frank Miller', '555 Redwood St', 'teacher'),
                                                             ('Grace Lee', '666 Willow St', 'staff'),
                                                             ('Hannah White', '777 Cherry St', 'student');

-- Crée la table `borrows`
CREATE TABLE IF NOT EXISTS `borrows` (
                                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                                         `book_id` INT NOT NULL,
                                         `member_id` INT NOT NULL,
                                         `borrow_date` DATE NOT NULL,
                                         `due_date` DATE NOT NULL,
                                         `return_date` DATE DEFAULT NULL,
                                         FOREIGN KEY (`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE,
                                         FOREIGN KEY (`member_id`) REFERENCES `members`(`id`) ON DELETE CASCADE
);

-- Insère des données de test dans la table `borrows`
INSERT INTO `borrows` (`book_id`, `member_id`, `borrow_date`, `due_date`, `return_date`) VALUES
                                                                                             (1, 1, '2025-01-01', '2025-01-15', NULL), -- En retard
                                                                                             (2, 2, '2025-01-10', '2025-01-20', NULL), -- En retard
                                                                                             (3, 3, '2025-01-12', '2025-01-30', NULL), -- Toujours en cours
                                                                                             (4, 4, '2025-01-15', '2025-01-28', '2025-01-27'), -- Retourné à temps
                                                                                             (5, 5, '2025-01-18', '2025-02-02', NULL), -- En cours
                                                                                             (6, 6, '2025-01-20', '2025-02-05', NULL), -- En cours
                                                                                             (7, 7, '2025-01-22', '2025-02-10', '2025-02-09'), -- Retourné à temps
                                                                                             (8, 8, '2025-01-25', '2025-02-15', '2025-02-14'), -- Retourné à temps
                                                                                             (9, 9, '2025-01-27', '2025-02-18', NULL), -- Toujours en cours
                                                                                             (10, 10, '2025-01-29', '2025-02-20', NULL); -- Toujours en cours
