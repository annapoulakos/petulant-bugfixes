<?php
if(!function_exists('array_map_reduce')){
	/**
	 * array_map_reduce
	 * Wrapper function for array_map + array_reduce
	 *
	 * @param <mixed[]> $array The array to perform the map reduce on.
	 * @param <Closure> $map_function The function to perform on the array_map sequence.
	 * @param <Closure> $reduce_function The function to perofrm on the array_reduce sequence.
	 * @param <mixed> $initial The initial value for the array_reduce function. Optional.
	 * @return <mixed> Returns the map-reduced array as a value.
	 */
	function array_map_reduce($array, $map_function, $reduce_function, $initial = null){
		return array_reduce(
			array_map($map_function, $array)
			, $reduce_function
			, $initial
			);
	}
}
