<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;


use CodeDelivery\Events\GetLocationDeliveryman;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Models\Geo;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class DeliverymanCheckoutController extends Controller
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

        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->scopeQuery(function($query) use($id){
            return $query->where('user_deliveryman_id','=',$id);
        })->paginate();


        return $orders;
    }


   public function show($id){

       $idDeliveryman = Authorizer::getResourceOwnerId();

       $order =  $this->orderRepository
           ->skipPresenter(false)
           ->getByIdAndDeliveryman($id,$idDeliveryman);

       /**
        * para forçar retorno do objeto produto
        */
//       $order->items->each(function($item){
//          $item->product;
//       });

       return $order;
   }


    public function updateStatus(Request $request, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();

        return $this->orderService->updateStatus($id, $idDeliveryman, $request->get('status'));
    }

  public function geo(Request $request,Geo $geo, $id){
      $idDeliveryman = Authorizer::getResourceOwnerId();

      $order = $this->orderRepository->getByIdAndDeliveryman($id,$idDeliveryman);

      $geo->lat = $request->get('lat');
      $geo->long = $request->get('long');

      /**
       * chamando evento para enviar via pusher
       */

      event(new GetLocationDeliveryman($geo,$order));

      return $geo;
  }

}
