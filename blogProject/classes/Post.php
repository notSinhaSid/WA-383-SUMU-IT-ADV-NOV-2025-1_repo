<?php
class Post {
    private $conn;
    private $tableName = 'posts_tb';

    public function __construct($conn){
        $this->conn = $conn;
    }
    
    // create post => can be done by both users/admin
    public function createPost($postTitle, $postContent, $postCoverImage, $postUserId, $postCategoryId, $postStatus) {
        $sql = "INSERT INTO {$this->tableName}(postTitle, postContent, postCoverImage, postUserId, postCategoryId, postStatus)
        VALUES(:postTitle, :postContent, :postCoverImage, :postUserId, :postCategoryId, :postStatus)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postTitle', $postTitle, PDO::PARAM_STR);
        $stmt->bindParam(':postContent', $postContent, PDO::PARAM_STR);
        $stmt->bindParam(':postCoverImage', $postCoverImage, PDO::PARAM_STR);
        $stmt->bindParam(':postUserId', $postUserId, PDO::PARAM_INT);
        $stmt->bindParam(':postCategoryId', $postCategoryId, PDO::PARAM_INT);
        $stmt->bindParam(':postStatus', $postStatus, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // to get the new id for the inserted post with the tags associated
    public function getLastInsertId()
    {
        return $this->conn->lastInsertId();
    }

    // get total post count
    public function getTotalPostCount($postUserId){
        $sql = "SELECT COUNT(postId) FROM {$this->tableName} WHERE postUserId = :postUserId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postUserId', $postUserId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // fetching the post only by the current user using there user id

    public function getCurrentUserPostById($postUserId, $limit = 5, $offset = 0) {
        $sql = "SELECT * FROM {$this->tableName} WHERE postUserId = :postUserId ORDER BY postID DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postUserId', $postUserId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get the post for edit and update based on the id of the current post
    public function getPostById($postId) {
        $sql = "SELECT * FROM {$this->tableName} WHERE postId = :postId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch();
    }

    // update function to perform the update on the current data
    public function updatePost($postId, $postTitle, $postContent, $postCoverImage, $postCategoryId, $postStatus) {
        $sql = "UPDATE {$this->tableName}
        SET postTitle = :postTitle, postContent = :postContent, postCoverImage = :postCoverImage, postCategoryId = :postCategoryId, postStatus = :postStatus WHERE postId = :postId";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postId' , $postId, PDO::PARAM_INT);
        $stmt->bindParam(':postTitle', $postTitle, PDO::PARAM_STR);
        $stmt->bindParam(':postContent', $postContent, PDO::PARAM_STR);
        $stmt->bindParam(':postCoverImage', $postCoverImage, PDO::PARAM_STR);
        $stmt->bindParam(':postCategoryId', $postCategoryId, PDO::PARAM_INT);
        $stmt->bindParam(':postStatus', $postStatus, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deletePost($postId) {
        $sql = "DELETE FROM {$this->tableName} WHERE postId = :postId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // searching / filter 
    public function searchPostUsingKeyword($keyword, $limit = 6 , $offset = 0, $postUserId = null) {
        $sql = "SELECT * FROM {$this->tableName} WHERE postTitle LIKE :keyword";
        if($postUserId) {
            $sql .= " AND postUserId = :postUserId";
        }

        $sql .= " ORDER BY postId DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', '%'. $keyword .'%' , PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if($postUserId){
            $stmt->bindParam(':postUserId', $postUserId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // -> to get total post count under the search filter 
    public function getTotalSearchCount($keyword, $postUserId=null) {
        $sql = "SELECT COUNT(postTitle) FROM {$this->tableName} WHERE postTitle LIKE :keyword";
        if($postUserId) {
            $sql .= " AND postUserId = :postUserId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        if($postUserId){
            $stmt->bindParam(':postUserId', $postUserId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // for public facing dashboard -> fetch all
    public function getAllPost($limit = 6, $offset = 0){
        $sql = "SELECT * FROM {$this->tableName} ORDER BY postId DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get total post count
    public function postCount() {
        $sql = "SELECT COUNT(postTitle) FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}