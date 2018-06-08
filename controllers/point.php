<?php
/**
 * @brief 添加积分
 * @class Point
 * @note  后台
 */
class Point extends IController implements adminAuthorization
{
	public $checkRight  = 'all';
    public $layout = 'admin';
    private $data = array();

	public function init()
	{

	}

	/**
	 * @point 积分添加
	 */
	function point_add()
	{
		if (!$_POST) {
			// 渲染模板
			$this->redirect('point_add');

		}else{
			// 接收数据
			$num = IFilter::act(IReq::get('sum_num'));
			$point = IFilter::act(IReq::get('sum_point'),'int');
			$is_show = IFilter::act(IReq::get('is_show'),'int');
			$time = date('Y-m-d H:i:s');
			$obj_point = new IModel('point_sum');
			$point_info = array(
				'sum_num' => $num,
				'sum_point' => $point,
				'start_time' => $time,
				'is_show' => $is_show
			);
			// 添加入库
			$obj_point->setData($point_info);
			if ($sum_id) {
				die("error");
			}else{
				if($obj_point->add()){
					$this->redirect('point_list');
				}	
			}
		}		
	}


	/*
	** 积分展示
	*/
	function point_list(){

		$obj_point = new IModel('point_sum');
		$point_arr = $obj_point->query();



		// foreach ($point_arr as $key => $value) {
		// 	if ($value['end_time'] == '0000-00-00 00:00:00') {
		// 		$point_arr[$key]['end_time'] = date('Y-m-d H:i:s');
		// 	}
		// }


		// $starttime = '2018-06-06 00:00:00';
		// $endtime   = '2018-06-06 23:59:59';
		$point_log = new IModel('point_log');
		$arr = $point_log->getObj("`datetime` > '".$starttime."' and `datetime` < '".$endtime."'",'sum(`value`)');
		

		echo "<pre>";
    print_r($point_arr);

		// $this->redirect('point_list');
	}
}
