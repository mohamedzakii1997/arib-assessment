//public function appendPricings(Request $request){
//    //try {
//
//    if($request->ajax()){
//        $data = $request->all();
//        $train_record = $request->input('training_id');
//        $ScriberT = Subscriber::where('id', $data['subscriber_id'])->select(['subscriber_type_id'])->get();
//        foreach ($ScriberT as $type){
//            $subType = $type->subscriber_type_id;
//        }
//
//        $trainings = Training::whereHas('pricings',function ($q) use ($subType)
//        {
//            $q->where('subscriber_type_id',$subType);
//        })->get();
//        $subscriberId = Subscriber::where('subscriber_type_id',$subType)->select(['subscriber_type_id'])->get();;
//        return view('Organization::subscriptions.components.append_prices',compact('subType','trainings','subscriberId'))->render();
//    }
////        } catch (\Exception $ex) {
////            return $this->response(500, 'Failed, Please try again later.', 200);
////        }
//    return $this->response(500, 'Failed, Please try again later.', 200);
//}
//public function appendTrainings(Request $request){
//    //try {
//
//    if($request->ajax()){
//        $data = $request->all();
//        $training_record = $request->input('training_id');
//        $ScriberT = Subscriber::where('id', $data['subscriber_id'])->select(['subscriber_type_id'])->get();
//        foreach ($ScriberT as $type){
//            $subscriberType = $type->subscriber_type_id;
//        }
//
//        $trainingsAll = Training::whereHas('pricings',function ($q) use ($subscriberType)
//        {
//            $q->where('subscriber_type_id',$subscriberType);
//        })->get();
//
//        return view('Organization::subscriptions.components.append_trainings',compact('trainingsAll','training_record','subscriberType'))->render();
//    }
////        } catch (\Exception $ex) {
////            return $this->response(500, 'Failed, Please try again later.', 200);
////        }
//    return $this->response(500, 'Failed, Please try again later.', 200);
//}
