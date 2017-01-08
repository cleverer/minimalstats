<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	require_once 'minimalstats.php';
	
	
	/**
	* Counter
	*/
	class Counter extends MS {
		
		private function createSVG() {
			
			$linePositionValues = array(
				'left' => array(
					'line' => array(
						'x1' => 1,
						'x2' => 1,
						'y1' => '0%',
						'y2' => '100%'
					),
					'text' => array(
						'x' => 6,
						'y'=> $this->config['FONT_SIZE']+2,
						'span_x' => $this->config['WIDTH']-4
					)
				),
				'right' => array(
					'line' => array(
						'x1' => $this->config['WIDTH']-1,
						'x2' => $this->config['WIDTH']-1,
						'y1' => '0%',
						'y2' => '100%'
					),
					'text' => array(
						'x' => 4,
						'y'=> $this->config['FONT_SIZE']+2,
						'span_x' => $this->config['WIDTH']-6
					)
				),
				'top' => array(
					'line' => array(
						'x1' => '0%',
						'x2' => '100%',
						'y1' => 1,
						'y2' => 1
					),
					'text' => array(
						'x' => 4,
						'y'=> $this->config['FONT_SIZE']+3,
						'span_x' => $this->config['WIDTH']-4
					)
				),
				'bottom' => array(
					'line' => array(
						'x1' => '0%',
						'x2' => '100%',
						'y1' => $this->config['HEIGHT']-1,
						'y2' => $this->config['HEIGHT']-1
					),
					'text' => array(
						'x' => 4,
						'y'=> $this->config['FONT_SIZE']+1,
						'span_x' => $this->config['WIDTH']-4
					)
				)

			);
			
			$positions = $linePositionValues[$this->config['LINE_POSITION']];
			
			ob_start();
			include $this->rootPath.'/templates/counter.php';
			return ob_get_clean();
		}
		
		private function processRequest() {
			
		}
		
		function newRequest() {
			header('Content-Type: image/svg+xml');
			echo $this->createSVG();
		}
		
	}
	
	$counter = new Counter(null, false);
	
	$counter->newRequest();
