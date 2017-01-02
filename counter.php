<?php
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
						'y'=> Config::FONT_SIZE+4,
						'span_x' => Config::WIDTH-4
					)
				),
				'right' => array(
					'line' => array(
						'x1' => Config::WIDTH-1,
						'x2' => Config::WIDTH-1,
						'y1' => '0%',
						'y2' => '100%'
					),
					'text' => array(
						'x' => 4,
						'y'=> Config::FONT_SIZE+4,
						'span_x' => Config::WIDTH-6
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
						'y'=> Config::FONT_SIZE+4,
						'span_x' => Config::WIDTH-4
					)
				),
				'bottom' => array(
					'line' => array(
						'x1' => '0%',
						'x2' => '100%',
						'y1' => Config::HEIGHT-1,
						'y2' => Config::HEIGHT-1
					),
					'text' => array(
						'x' => 4,
						'y'=> Config::FONT_SIZE+2,
						'span_x' => Config::WIDTH-4
					)
				)

			);
			
			$positions = $linePositionValues[Config::LINE_POSITION];
			
			ob_start();
			include 'templates/counter.php';
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
