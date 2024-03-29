<?php

namespace App\Services;

use App\Exceptions\EntriesApiException;
use App\Repository\Category\ICategoryRepository;
use App\Repository\Entity\IEntityRepository;
use GuzzleHttp\Client;
 
class EntriesApiService
{

	public function __construct(
		private IEntityRepository $entityRepository,
		private ICategoryRepository $categoryRepository,
		private Client $client
		) {}

	public function getEntries()
	{
		try {
			$response = $this->client->get('https://api.publicapis.org/entries');
			if ($response->getStatusCode() !== 200) {
				throw new EntriesApiException();
			}
			$data = json_decode($response->getBody(), true);
			foreach ($data['entries'] as $entry) {
				$this->processEntry($entry);
			}
			return 'Entries added successfully';
		} catch (\Exception $e) {
			echo($e->getMessage());
			throw new EntriesApiException();
		}
	}
	
	private function processEntry($entry)
	{
		$category = $this->categoryRepository->getByName($entry['Category']);
		if ($category) {
			$entry['category_id'] = $category->id;
			$this->entityRepository->create($entry);
		}
	}

}