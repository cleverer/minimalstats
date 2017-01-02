<?php
	namespace MinimalStats;
?><?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full" width="<?php echo Config::WIDTH;?>" height="<?php echo Config::HEIGHT;?>" viewPort="0 0 <?php echo Config::WIDTH;?> <?php echo Config::HEIGHT;?>">
	<rect x="0" y="0" fill="<?php echo Config::BACKGROUND_COLOR;?>" width="100%" height="100%"></rect>
	<line stroke="<?php echo Config::LINE_COLOR;?>" x1="<?php echo $positions['line']['x1'];?>" y1="<?php echo $positions['line']['y1'];?>" x2="<?php echo $positions['line']['x2'];?>" y2="<?php echo $positions['line']['y2'];?>" stroke-width="2"></line>
	<text x="<?php echo $positions['text']['x'];?>" y="<?php echo $positions['text']['y'];?>" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: <?php echo Config::FONT_SIZE;?>; color:#373a3c; font-weight: lighter;">
		Visitors
		<tspan style="font-weight: bold;" text-anchor="end" x="<?php echo $positions['text']['span_x'];?>">
			20
		</tspan>
	</text>
</svg>
