<tr>
    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $token->id }}</td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $isLatest ? Auth::user()->api_token : '********' }}</td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ join(',', $token->abilities) }}  </td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $token->updated_at }}</td>
    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
        <a wire:click="deleteToken" wire:loading.attr="disabled" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">Delete</a>
    </td>
</tr>
