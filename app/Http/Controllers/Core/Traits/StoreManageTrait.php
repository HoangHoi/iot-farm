<?php

namespace App\Http\Controllers\Core\Traits;

use App\Core\Responses\Store\ManageResponse;
use Illuminate\Http\Request;
use App\Models\Store;

trait StoreManageTrait
{
    public function update(Store $store, Request $request)
    {
        $this->validateUpdateRequest($request, $store);

        try {
            $storeData = $request->only($this->updateFields);
            $store->update($storeData);

            return ManageResponse::updateStoreResponse('success', $store->load(['partner'])->toArray());
        } catch (Exception $e) {
            return ManageResponse::updateStoreResponse('error');
        }
    }

    protected function createOrUpdate($storeData, $id = null)
    {
        return Store::updateOrCreate(['id' => $id], $storeData);
    }
}
