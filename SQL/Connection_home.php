<?php

$top_authors_sql = "
SELECT users.id, users.username, users.profile_picture, COUNT(stories.id) AS story_count
FROM stories
JOIN users ON stories.user_id = users.id
WHERE YEARWEEK(stories.created_at, 1) = YEARWEEK(CURDATE(), 1)
GROUP BY users.id, users.username, users.profile_picture
ORDER BY story_count DESC
LIMIT 3
";
$top_authors = $conn->query($top_authors_sql);

// Query para top 10 livros da semana
$top_books_sql = "
SELECT * FROM stories
WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)
ORDER BY views DESC
LIMIT 10
";
$top_books = $conn->query($top_books_sql);

// Query para os 5 livros mais recentes
$recent_books_sql = "
SELECT * FROM stories
ORDER BY created_at DESC
LIMIT 5
";
$recent_books = $conn->query($recent_books_sql);

?>