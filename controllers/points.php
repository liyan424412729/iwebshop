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
			$end_time = IFilter::act(IReq::get('end_time'));
			$end_times = $end_time.' 23:59:59';
			$is_show = IFilter::act(IReq::get('is_show'),'int');
			$time = date('Y-m-d H:i:s');

			if ($end_time == '' || $end_times < $time) {
				echo "<script>alert('请填写正确时间');location.href='/points/point_add';</script>";
				die;
			}

			$obj_point = new IModel('point_sum');

			// 判断上期是否结束
			$arr = $obj_point->getObj('sum_status=1');
			if ($arr) {
				echo "<script>alert('上期未结束');location.href='/points/point_add';</script>";
				die;
			}

			$point_info = array(
				'sum_num' => $num,
				'sum_point' => $point,
				'start_time' => $time,
				'end_time' => $end_times,
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
		// var_dump(self::$point_arr);die;

		// // 查询积分增减记录表
		// $point_Log = new IQuery('point_log as plog');


		// echo "<pre>";
  //   print_r($point_Log);die;

		// // 查询总积分表
		$pointHandle = new IQuery('point_sum as po');
		// // $pointHandle->fields   = "po.sum_id,po.sum_sum,po.sum_point,po.start_time,po.end_time,po.is_show";
		$pointHandle->where    = 'is_show=1';
		$this->pointHandle = $pointHandle;
		// // echo "<pre>";
  //   // print_r($this->pointHandle);.
		$this->redirect("point_list");

	}


	/*
	** 积分列表删除
	*/
	public function point_del(){
		$sum_id = (int)IReq::get('sum_id');
		if ($sum_id) {
			$point_sum_obj = new IModel('point_sum');
			$point_sum = $point_sum_obj->getObj('sum_id='.$sum_id);
			if ($point_sum['sum_status'] == 1) {
				echo "<script>alert('本期还未结束');location.href='/points/point_list';</script>";
				die;
			}
			$arr = array('is_show'=>0);
			$point_sum_obj->setData($arr);
			$point_sum_obj->update('sum_id='.$sum_id);
		}
		$this->redirect('point_list');

	}




}
