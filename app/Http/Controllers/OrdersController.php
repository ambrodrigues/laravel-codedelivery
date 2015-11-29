<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 27/11/15
 * Time: 22:26
 */

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Http\Requests\AdminOrderRequest;
use CodeDelivery\Http\Requests\Request;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{


    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function index(){
        $orders = $this->orderRepository->paginate();

        return view('admin.orders.index',compact('orders'));
    }

    public function edit($id,UserRepository $userRepository){

        $listStatus = [
            0=>'Pendente',
            1=>'A Caminho',
            2=>'Entregue'

        ];

        $order = $this->orderRepository->find($id);

        $deliveryMan = $userRepository->getDeliverymen();

        return view('admin.orders.edit',compact('order','listStatus','deliveryMan'));
    }



    public function update(AdminOrderRequest $request,$id){
        $data = $request->all();

        $this->orderRepository->update($data,$id);

        return redirect()->route('admin.orders.index');
    }
}