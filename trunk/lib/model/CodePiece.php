<?php

/**
 * Subclass for representing a row from the 'code_piece' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CodePiece extends BaseCodePiece
{
}

sfPropelBehavior::add('CodePiece', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('CodePiece', array('sfPropelActAsCommentableBehavior') );
sfPropelBehavior::add('CodePiece', array('sfPropelActAsTaggableBehavior'));
sfPropelBehavior::add('CodePiece', array('sfPropelActAsRatableBehavior' => array('max_rating' => 5))); // Max rating value for a recipe
              