<?php



Route::get('campaign/{campaignUuid}', 'CampaignFrontendController@display')->name('campaign.display');
Route::post('campaign/{campaignUuid}/submit', 'CampaignFrontendController@submit')->name('campaign.submit');

// Protected route for viewing submissions
Route::middleware(['auth'])->group(function () {
    Route::get('participations', 'ParticipationController@index')->name('participations.index');
});

