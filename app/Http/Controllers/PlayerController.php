<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;

class PlayerController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchData(Request $request)
    {
        // Get parameters from the request
        $params = $this->validateRequest($request);

        $client = new Client();
        $response = $client->get('https://api.wiseoldman.net/v2/players/search?' . http_build_query($params));

        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }

    private function validateRequest(Request $request) {
        try {
            $validatedData = $request->validate([
                'username' => 'required',
            ]);

            return $validatedData;

        } catch (ValidationException $e) {
            // Handle validation failure
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    /**
     * GET/players/search
    *
    * Searches players by partial username. Returns an array of Player objects.
    *
    * Query Params
    * @param  string username  string  true  The partial username for the player you're trying to search for.
    * @param  string limit integer false The pagination limit. See Pagination
    * @param  string offset  integer false The pagination offset. See Pagination
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/search?username=zezi&limit=2
    */
    public function searchPlayers (Request $request) {
    	$acceptedRequestParams = [];
        $acceptedQueryParams = [
        	'username' => 'required|string',
        	'limit' => 'nullable|string',
        	'foo' => 'nullable|string',
        ];
        $this->validateRequest($request->all(), $acceptedQueryParams);
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/search?username=zezi&limit=2' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
      
    /**
     * Update a Player
    * POST/players/:username
    *
    * Tracks or updates a player. Returns a PlayerDetails object on success, which includes their latest snapshot.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima
    */
    public function updateAPlayer (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
      
    /**
     * POST/players/:username/assert-type
    *
    * Asserts (and attempts to fix, if necessary) a player's game-mode type. Returns the updated Player and an indication of whether the type was changed.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/assert-type
    */
    public function assertPlayerType (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/assert-type';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * GET/players/:username
    *
    * Fetches a player's details. Returns a PlayerDetails object.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima
    */
    public function getPlayerDetails (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * GET/players/id/:id
    *
    * Fetches a player's details by their ID. Returns a PlayerDetails object.
    *
    * Request Params
    * @param  string id  number  true  The player's ID.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/id/123
    */
    public function getPlayerDetailsID (Request $request) {
    	$acceptedRequestParams = [
        	'id' => 'required|int',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $id = $request->input('id');
        $endpoint = 'https://api.wiseoldman.net/v2/players/id/{$id}';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * GET/players/:username/achievements
    *
    * Fetches a player's current achievements. Returns an array of Achievement objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/achievements
    */
    public function getPlayerAchievements (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/achievements';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Achievement Progress
    * GET/players/:username/achievements/progress
    *
    * Fetches a player's current progress towards every possible achievement. Returns an array of AchievementProgress objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/achievements/progress
    */
    public function getPlayerAchievementProgress (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/achievements/progress';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Competition Participations
    * GET/players/:username/competitions
    *
    * Fetches all of the player's competition participations. Returns an array of PlayerParticipation objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Query Params
    * @param  string status  CompetitionStatus false The competition status filter.
    * @param  string limit integer false The pagination limit. See Pagination
    * @param  string offset  integer false The pagination offset. See Pagination
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/competitions
    */
    public function getPlayerCompetitionParticipations (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'status' => 'nullable|string|in:upcoming, ongoing, finished',
        	'limit' => 'nullable|integer',
        	'offset' => 'nullable|integer',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/competitions' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Competition Standings
    * GET/players/:username/competitions/standings
    *
    * Fetches all of the player's competition standings. Returns an array of PlayerCompetitionStanding objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Query Params
    * @param  string status  CompetitionStatus true  The competition status filter.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/competitions/standings?status=ongoing
    */
    public function getPlayerCompetitionStandings (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'status' => 'nullable|string|in:upcoming, ongoing, finished',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/competitions/standings' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Group Memberships
    * GET/players/:username/groups
    *
    * Fetches all of the player's group memberships. Returns an array of PlayerMembership objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Query Params
    * @param  string limit integer false The pagination limit. See Pagination
    * @param  string offset  integer false The pagination offset. See Pagination
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/groups
    */
    public function getPlayerGroupMemberships (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'limit' => 'nullable|integer',
        	'offset' => 'nullable|integer',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/groups' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Gains
    * GET/players/:username/gained
    *
    * Fetches all of the player's for a specific period or time range. Returns a PlayerGains object.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Query Params
    * @param  string period  Period  false The duration of the gains' time range.
    * @param  string startDate date  false The start date of the gains' time range.
    * @param  string endDate date  false The end date of the gains' time range.
    * INFO
    * This endpoint accepts either period or startDate + endDate.
    *
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/gained?period=week
    */
    public function getPlayerGains (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'period' => 'nullable|string',
        	'startDate' => 'nullable|string',
        	'endDate' => 'nullable|string',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/gained?period=week' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * GET/players/:username/records
    *
    * Fetches all of the player's records. Returns an array of Record objects.
    *
    * Request Params*
    * * @param  string username  string  true  The player's username.
    *
    * Query Params
    * @param  string period  Period  false The record's time period.
    * @param  string metric  Metric  false The record's metric.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/records?metric=agility
    */
    public function getPlayerRecords (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'foo' => 'nullable|string',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/records?metric=agility' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Snapshots
    * GET/players/:username/snapshots
    *
    * Fetches all of the player's past snapshots. Returns an array of Snapshot objects.
    *
    * Request Params*
    * * @param  string username  string  true  The player's username.
    *
    * Request Params
    * @param  string period  Period  false The period to filter the snapshots by.
    * @param  string startDate date  false The minimum date for the snapshots.
    * @param  string endDate date  false The maximum date for the snapshots.
    * INFO
    * This endpoint accepts either period or startDate + endDate.
    *
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/snapshots?period=week
    */
    public function getPlayerSnapshots (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'foo' => 'nullable|string',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/snapshots?period=week' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Snapshots Timeline
    * GET/players/:username/snapshots/timeline
    *
    * Fetches all of the player's past snapshots (as a value/date timeseries array). Returns an array of Timeline Datapoints objects.
    *
    * Request Params*
    * * @param  string username  string  true  The player's username.
    *
    * Request Params
    * @param  string metric  Metric  true  The record's metric.
    * @param  string period  Period  false The period to filter the snapshots by.
    * @param  string startDate date  false The minimum date for the snapshots.
    * @param  string endDate date  false The maximum date for the snapshots.
    * INFO
    * This endpoint accepts either period or startDate + endDate.
    *
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/snapshots/timeline?metric=magic&period=week
    */
    public function getPlayerSnapshotsTimeline (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $acceptedQueryParams = [
        	'foo' => 'nullable|string',
        ];
        $this->validateRequest(
        	$request->all(), 
        	array_merge(
        		$acceptedRequestParams,
        		$acceptedQueryParams,
        	)
        );
        $username = $request->input('username');

    	$queryParamString = $this->getQueryParamString($request, $acceptedQueryParams);
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/snapshots/timeline?metric=magic&period=week' . $queryParamString;

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }      

    /**
     * Get Player Name Changes
    * GET/players/:username/names
    *
    * Fetches all of the player's approved name changes. Returns an array of NameChange objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/names
    */
    public function getPlayerNameChanges (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/names';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }
    
    /**
     * Get Player Archives
    * GET/players/:username/archives
    *
    * Fetches all previous archived player profiles that held this username. Returns an array of PlayerArchiveWithPlayer objects.
    *
    * Request Params
    * @param  string username  string  true  The player's username.
    *
    * Sample Url: https://api.wiseoldman.net/v2/players/zezima/archives
    */
    public function getPlayerArchives (Request $request) {
    	$acceptedRequestParams = [
        	'username' => 'required|string',
        ];
        $this->validateRequest($request->all(), $acceptedRequestParams);
        $username = $request->input('username');
        $endpoint = 'https://api.wiseoldman.net/v2/players/{$username}/archives';

        $client = new Client();
        $response = $client->get($endpoint);        
        $data = json_decode($response->getBody(), true);  
        return response()->json($data);
    }


    public function getQueryParamString(Request $request, array $queryParams) {
        $queryParams = [];
        foreach ($queryParams as $paramName => $value) {
	        $param = $request->input('$paramName');
	        if ($param !== null) {
	        	$queryParams[] = $param;
	    	}
	    }	

    	$queryParamString = '';
    	if (count($queryParams) > 1) {
    		$queryParamString = '?' . http_build_query($queryParams, '', '&');
    	}

    	return $queryParamString;
    }
}
