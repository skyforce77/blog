CREATE TRIGGER `posts_before_delete` BEFORE DELETE ON `posts`
 FOR EACH ROW BEGIN

  DELETE FROM comments WHERE posts_id = OLD.id;
  DELETE FROM posts_categories WHERE posts_id = OLD.id;
   
END