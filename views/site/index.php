<?php

/* @var $this yii\web\View */

use app\assets\AppAsset;
use yii\helpers\Url;

$this->registerJsFile('@web/js/ajaxRoutine.js', ['depends' => AppAsset::className()]);

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div>
        <h1>Phonebook</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <h3>About project</h3>
                <p>
                    This project consist of two parts: frontend (current page) and backend (administration pages).<br /><br />
                    <strong>On current page</strong> you could perform search against phone number, persons surname(name) or its address.
                    For surname search was used MySQL FULLTEXT search in boolean mode(whole words or its beginning), for phone number
                    and address searches were used searches based on LIKE condition.<br />
                    Results, if any, will be shown in grid below the search input. <br /><br />
                    Phone number could contain plus sign "<strong>+</strong>", hyphens "<strong>-</strong>",
                    brackets "<strong>()</strong>", and spaces " ". Phone number should contain from 2 up to 12 digits in itself.
                    Formatting of phone number - its all up to you.<br /><br />
                    <strong>Administration pages</strong> (Links in main menu: "Phones" and "Users") accessible only for logined users. There is only
                    one administrator that could add new users, or could update or delete users. This user has following credentials:
                    <ul>
                        <li><strong>Login:</strong> admin@example.com</li>
                        <li><strong>Password:</strong> qwerty</li>
                    </ul>
                    Other registered users could view other users info only.<br /><br />
                    All logined users could <em>view/add/update/delete</em> phone number records stored in database.<br /><br />
                    <strong>Testing:</strong> for the time save sake I've covered by unit tests only the User model.<br /><br />
                    <em><strong>Wish you nice exploring this project</strong></em>

                </p>
            </div>
            <div class="col-lg-3">
                <h4>Search by phone number</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input id="number-input" type="text" placeholder="Enter phone number...   " class="form-control">
                              <span class="input-group-btn">
                                <button class="btn btn-default ajax-button" data-type="number" data-baseurl="<?=Url::to(['phone/ajax']);?>" type="button">Go!</button>
                              </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
            <div class="col-lg-3">
                <h4>Search by Surname and Name</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input id="name-input" type="text" placeholder="Enter name...   " class="form-control">
                              <span class="input-group-btn">
                                <button class="btn btn-default ajax-button" data-type="surname" data-baseurl="<?=Url::to(['phone/ajax']);?>" type="button">Go!</button>
                              </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
            <div class="col-lg-3">
                <h4>Search by address</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input id="address-input" type="text" placeholder="Enter address...   " class="form-control">
                              <span class="input-group-btn">
                                <button class="btn btn-default ajax-button" data-type="address" data-baseurl="<?=Url::to(['phone/ajax']);?>" type="button">Go!</button>
                              </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
            <div class="col-lg-9"><hr /></div>
            <div id="search-container" class="col-lg-9"></div>
        </div>
    </div>
</div>