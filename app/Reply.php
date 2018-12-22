<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content', 'user_id', 'discussion_id'];

    /*
    	Relationship with Users
    	A reply BelongsTo a user (one user)
     */
    public function user() {
    	return $this->BelongsTo('App\User');
    }

    /*
    	Relationship with Discussion
    	A reply BelongsTo a Discussion
     */
    public function discussion() {
    	return $this->BelongsTo('App\Discussion');
    }
    /**
     * Relation with likes
     */
    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function is_liked_by_auth_user() {
        $id = Auth::id();
        $likers = array();
        foreach ($this->likes as $like) {
            array_push($likers, $like->user_id);
        } // end foreach
        if (in_array($id, $likers)) {
            return TRUE;
        }// end if
        else{
            return FALSE;
        }// end else
    } // method ends
    public function points($points) {
        if ($points == 5) {
            echo "<b title='beginner'>👶</b>";
        }elseif($points == 25){
            echo "<b title='expert'>👓</b>";
        }elseif ($points < 40 || $points == 45) {
            echo "<b title='nerd'>🕶</b>";
        }elseif($points > 100){
            echo "<b title='Black-Hat'>🎩</b>";
        }else{
            echo "<b title='Degree'>🎓</b>";
        }
    }
}
