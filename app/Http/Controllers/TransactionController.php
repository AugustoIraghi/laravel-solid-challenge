<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use App\Mail\TransactionCreated;
use App\Strategies\EmailNotificationStrategy;
use App\Strategies\DatabaseLoggingStrategy;
use App\Services\TransactionFilterService;

class TransactionController extends Controller
{
    protected $filterService;
    protected $notificationStrategy;
    protected $loggingStrategy;

    public function __construct()
    {
        $this->filterService = new TransactionFilterService();

        $this->notificationStrategy = new EmailNotificationStrategy();
        $this->loggingStrategy = new DatabaseLoggingStrategy();
    }
    /**
     * Display a listing of the transactions.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Transaction::query();

        // Define filter rules based on request parameters
        $filterRules = [
            'type' => 0,
            'amount' => $request->get('amount'),
            'date' => $request->get('date'),
        ];

        // Apply the filters
        $transactions = $this->filterService->applyFilters($query, array_filter($filterRules))->get();

        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param  \App\Http\Requests\TransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());

        // Send notification based on the strategy
        $this->notificationStrategy->send($transaction);

        // Log the transaction based on the strategy
        $this->loggingStrategy->log('Transaction created', ['transaction_id' => $transaction->id]);

        // Broadcast the transaction
        broadcast(new TransactionCreated($transaction))->toOthers();

        return new TransactionResource($transaction);
    }

    /**
     * Display the specified transaction.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json(null, 204);
    }
}
