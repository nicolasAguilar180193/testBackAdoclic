<?php

namespace App\Services;

use App\Exceptions\EntriesApiException;
use App\Models\Category;
use App\Models\Entity;
use GuzzleHttp\Client;
 
class EntriesApiService
{
	public function getEntries()
	{
		$client = new Client();
		try {
			$response = $client->get('https://api.publicapis.org/entries');
			if ($response->getStatusCode() == 200) {
				$data = json_decode($response->getBody(), true);
				foreach ($data['entries'] as $entry) {
					if (in_array($entry['Category'], ['Animals', 'Security'])) {
						$category = Category::where('category', $entry['Category'])->first();
	
						Entity::insertOrIgnore([
							'api' => $entry['API'],
							'description' => $entry['Description'],
							'link' => $entry['Link'],
							'category_id' => $category->id,
						]);
					}
				}
			}
			return 'Entries added successfully';
		} catch (\Exception $e) {
			throw new EntriesApiException();
		}
		
	}
}