<?php

namespace app\models;

use app\libraries\Core;
use app\libraries\DateUtils;

/**
 *
 * Class PollModel
 *
 * @method int getId()
 * @method string getName()
 * @method string getQuestion()
 * @method array getAnswers()
 * @method array getUserResponses()
 * @method string|null getImagePath()
 */
class PollModel extends AbstractModel {
    /** @prop-read int */
    protected $id;
    /** @prop-read string */
    protected $name;
    /** @prop-read string */
    protected $question;
    protected $responses;
    /** @prop-read array */
    protected $answers;
    /** @prop-read array */
    protected $user_responses;
    protected $release_date;
    protected $status;
    /** @prop-read string|null */
    protected $image_path;

    public function __construct(Core $core, $id, $name, $question, array $responses, array $answers, $status, array $user_responses, $release_date, $image_path) {
        parent::__construct($core);
        $this->id = $id;
        $this->name = $name;
        $this->question = $question;
        $this->responses = $responses;
        $this->answers = $answers;
        $this->status = $status;
        $this->user_responses = $user_responses;
        $this->release_date = $release_date;
        $this->image_path = $image_path;
    }

    public function getResponses() {
        return array_keys($this->responses);
    }

    public function getResponsesWithKeys() {
        return $this->responses;
    }

    public function getAnswers() {
        return $this->answers;
    }

    public function isOpen() {
        return $this->status == "open";
    }

    public function isClosed() {
        return $this->status == "closed";
    }

    public function isEnded() {
        return $this->status == "ended";
    }

    public function getUserResponse($user_id) {
        if (!isset($this->user_responses[$user_id])) {
            return null;
        }
        return $this->user_responses[$user_id];
    }

    public function getResponseString($response_id) {
        if (isset($this->responses[$response_id])) {
            return $this->responses[$response_id];
        }
        return "No Response";
    }

    public function getReleaseDate() {
        return $this->release_date;
    }

    public function isCorrect($response) {
        return in_array($response, $this->getResponses()) && in_array($response, $this->answers);
    }

    public function isInPast() {
        return date("Y-m-d") > $this->release_date;
    }

    public function isInFuture() {
        return date("Y-m-d") < $this->release_date;
    }

    public function isToday() {
        return date("Y-m-d") == $this->release_date;
    }
}
