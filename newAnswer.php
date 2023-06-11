<form class="mt-3" action="processNewAnswer.php" method="POST">
    <div class="mb-3">
        <label for="newAnswer" class="form-label">Your Answer</label>
        <textarea class="form-control" id="newAnswer" name="newAnswer" rows="3"></textarea>
    </div>
    <input type="hidden" name="questionId" value="<?php echo $record['questionId']; ?>">
    <button type="submit" class="btn btn-primary" name="submitAnswer">Submit Answer for Approval</button>
</form>
