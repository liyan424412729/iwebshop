<?php
/**
 * @brief 添加积分
 * @class Point
 * @note  后台
 */
class Points extends IController implements adminAuthorization
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

		// foreach ($point_arr as $key => $value) {
		// 	if ($value['end_time'] == '0000-00-00 00:00:00') {
		// 		$point_arr[$key]['end_time'] = date('Y-m-d H:i:s');
		// 	}
		// }


		// $starttime = '2018-06-06 00:00:00';
		// $endtime   = '2018-06-06 23:59:59';
		// $point_log = new IModel('point_sum');
		// $arr = $point_log->getObj("`datetime` > '".$starttime."' and `datetime` < '".$endtime."'",'sum(`value`)');
		//拼接sql
		$pointHandle = new IQuery('point_sum as po');
		// $pointHandle->order    = "po.sum_id desc";
		// $pointHandle->fields   = "po.*,po.sum_id,po.sum_sum,po.sum_point,po.start_time,po.end_time";
		$this->pointHandle = $pointHandle;
		// echo "<pre>";
  //   print_r($this->pointHandle->find());
		$this->redirect("point_list");

		

		//$this->redirect('point_list');
	}
}
