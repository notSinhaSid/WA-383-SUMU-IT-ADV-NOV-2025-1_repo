<?php
class Tag
{
    private $conn;
    private $tableName = 'tags_tb';
    private $tableName2 = 'post_tags_tb';

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // check if the tags exists or not, if not then create
    public function findOrCreateTag($tagName){
        $sql = "SELECT tagId FROM {$this->tableName} WHERE tagName = :tagName";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tagName', $tagName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();

        if(!$result){
            $sql = "INSERT INTO {$this->tableName}(tagName)VALUES(:tagName)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tagName', $tagName, PDO::PARAM_STR);
            $stmt->execute();
            return $this->conn->lastInsertId();
        }
        else{
            return $result['tagId'];
        }
    }
    // function for attaching the tags
    public function attachToPost($postId, $tagId)
    {
        $sql = "INSERT INTO post_tags_tb(postId, tagId) VALUES(:postId, :tagId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':tagId',  $tagId,  PDO::PARAM_INT);
        return $stmt->execute();
    }

    // function to get the tags for when a editing a post
    public function getTagByPostId($postId) {
        $sql = "SELECT tagName FROM {$this->tableName}
        INNER JOIN {$this->tableName2} ON {$this->tableName}.tagId = {$this->tableName2}.tagId WHERE {$this->tableName2}.postId = :postId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // clearing of tags when posts are updated
    public function deleteTagByPostId($postId) {
        $sql = "DELETE FROM {$this->tableName2} WHERE postId = :postId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // get total tag count for admin dashboard
    public function getTotalTagCount() {
        $sql = "SELECT COUNT(tagName) FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}