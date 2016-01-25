<?php

namespace CodeDelivery\Http\Controllers\Api\Client;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ClientCheckoutController extends Controller
{


    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    private $with = ['client','cupom','items'];

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    ) {

        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }

    public function index(){

        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;

        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use($clientId){
            return $query->where('client_id','=',$clientId);
        })->paginate();


        return $orders;
    }


   public function show($id){
       $order =  $this->orderRepository
           ->skipPresenter(false)
           ->with($this->with)
           ->find($id);

       /**
        * para forçar retorno do objeto produto
        */
//       $order->items->each(function($item){
//          $item->product;
//       });

       return $order;
   }


    public function store(CheckoutRequest $request){
        $data = $request->all();

        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;

        $data['client_id'] = $clientId;

        $order = $this->orderService->create($data);

        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($order->id);
    }


    public function update(AdminCategoryRequest $request,$id){
        $data = $request->all();

        $this->service->update($data,$id);

        return redirect()->route('admin.categories.index');
    }

}
