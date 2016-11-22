<?php
	// Remove indexes and adds the size property
	function formatForD3($array, $size = 1000) {
		$formatted = [];
		$siblingSize = $size/sizeof($array);
		foreach ($array as $key => $value) {
			if (isset($value['children'])) {
				$value['children'] = formatForD3($value['children'], $siblingSize);
			} else {
				$value['size'] = $siblingSize;
			}
			$formatted[] = $value;
		}
		return $formatted;
	}
?>
<style type="text/css">
	.node {
		cursor: pointer;
	}

	.node:hover {
	 	stroke: #000;
		stroke-width: 1.5px;
	}

	.leaf {
		fill: #f9fcfd;
	}

	.label {
		font: 20px "Helvetica Neue", Helvetica, Arial, sans-serif;
		text-anchor: middle;
		text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;
	}

	.label,
	.node--root,
	.leaf {
		pointer-events: none;
	}
</style>
<svg width="600" style="width: 100%" height="600"></svg>
<script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script>
<script type="text/javascript">
	var svg = d3.select("svg");
	var margin = 20;
	var diameter = +svg.attr("width");
	var g = svg.append("g").attr("transform", "translate(" + diameter / 2 + "," + diameter / 2 + ")");

	var color = d3.scaleLinear()
	    .domain([-1, 5])
	    .range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
	    .interpolate(d3.interpolateHcl);

	var pack = d3.pack()
	    .size([diameter - margin, diameter - margin])
	    .padding(2);

	var root = <?= json_encode(formatForD3($tree)[0]) ?>;
	root = d3.hierarchy(root)
		.sum(function(d) { return d.size; })
	    .sort(function(a, b) { return b.value - a.value; });

	var focus = root;
	var nodes = pack(root).descendants();
	var view;

	var circle = g.selectAll("circle")
		.data(nodes)
	    .enter().append("circle")
	    .attr("class", function(d) {
	    	return d.parent ? d.children ? "node" : "node leaf" : "node node--root"; 
      	})
	    .style("fill", function(d) {
	    	return d.children ? color(d.depth) : null;
	    })
	    .on("click", function(d) {
	    	if (focus !== d) {
	    		zoom(d), d3.event.stopPropagation();
	    	}
	    });

	var text = g.selectAll("text")
	  	.data(nodes)
	    .enter().append("text")
	    .attr("class", "label")
	    .style("fill-opacity", function(d) {
	    	return d.parent === root ? 1 : 0; 
	    })
	    .style("display", function(d) {
	    	return d.parent === root ? "inline" : "none";
	    })
	    .text(function(d) {
	    	return d.data.name;
	    });

	var node = g.selectAll("circle,text");
	svg.style("background", color(-1)).on("click", function() {
    	zoom(root);
    });
	zoomTo([root.x, root.y, root.r * 2 + margin]);
	
	function zoom(d) {
	    var focus0 = focus; focus = d;
	    var transition = d3.transition()
	        .duration(d3.event.altKey ? 7500 : 750)
	        .tween("zoom", function(d) {
	        	var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r * 2 + margin]);
	        	return function(t) { zoomTo(i(t)); };
	        });

	    transition.selectAll("text")
	    	.filter(function(d) { return d.parent === focus || this.style.display === "inline"; })
	        .style("fill-opacity", function(d) { return d.parent === focus ? 1 : 0; })
	        .on("start", function(d) { if (d.parent === focus) this.style.display = "inline"; })
	        .on("end", function(d) { if (d.parent !== focus) this.style.display = "none"; });
	}

    function zoomTo(v) {
		var k = diameter / v[2]; view = v;
	    node.attr("transform", function(d) { return "translate(" + (d.x - v[0]) * k + "," + (d.y - v[1]) * k + ")"; });
	    circle.attr("r", function(d) { return d.r * k; });
	}
</script>