<?php

namespace App;

class Calendar {
	
	protected $date;
	protected $month;
	protected $year;
	protected $events;
	protected $allNames;
	
	public function __construct( $userDate = null )
	{
		setlocale( LC_TIME, "pl_PL" );
		$this->date = new \DateTime( $userDate );
		
		$this->NamesOfDays();
		$this->figureMonth();
		$this->figureYear();
		$this->MonthsToPolish();
	}
	
	protected function NamesOfDays()
	{
		$date = clone $this->date;
		
		$date->modify( 'mon' );
		$days = array();
		
		for( $x = 1; $x <= 7; $x++ )
		{
			$days[ $x ] = $date->format( 'D' );
			$date->modify( '+1 day' );
		}
		$this->allNames = $days;
	}
	
	protected function getHeading()
	{
		return "<tr><td colspan=\"7\">$this->month $this->year</td></tr><tr><td>Poniedziałek</td><td>Wtorek</td><td>Środa</td><td>Czwartek</td><td>Piątek</td><td>Sobota</td><td>Niedziela</td></tr>";
	}
	
	protected function getAllNames()
	{
		return $this->allNames;
	}
	
	protected function parseEvents()
	{
		foreach( $this->events as $key => $value )
		{
			$date = new \DateTime( $this->events[ $key ]['date'] );
			$this->events[ $key ]['date'] = (int)$date->format( 'd' );
		}
	}
	
	protected function checkForEvent( $day )
	{
		if( is_array( $this->events ) )
		{
			foreach( $this->events as $event )
			{
				if( $event['date'] === $day )
				{
					return $event;
				}
			}
		}
		
		return false;
	}
	
	protected function MonthsToPolish()
	{
		$english = array(
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'November',
			'December',
		);
		
		$polish = array(
			'Styczeń',
			'Luty',
			'Marzeć',
			'Kwiecień',
			'Maj',
			'Czerwiec',
			'Lipiec',
			'Sierpień',
			'Wrzesień',
			'Październik',
			'Listopad',
			'Grudzień',
		);
		
		$this->month = str_replace( $english, $polish, $this->month );
	}
	
	protected function figureMonth()
	{
		$this->month = $this->date->format( 'F' );
	}
	
	protected function figureYear()
	{
		$this->year = $this->date->format( 'Y' );
	}
	
	public function todayInNumber()
	{
		return (int)$this->date->format( 'd' );
	}
	
	public function getFirstDayInNameOfThisMonth()
	{
		$date = clone $this->date;
		
		return $firstDay = $date->modify( 'first day of this month' )->format( 'D' );
	}
	
	public function getLastDayInNumberOfMonth()
	{
		$date = clone $this->date;
		
		return (int)$firstDay = $date->modify( 'last day of this month' )->format( 'd' );
	}
	
	public function setEvents( $events )
	{
		$this->events = $events;
		$this->parseEvents();
	}
	
	public function daysToOmitInCalendar()
	{
		$firstDay = $this->getFirstDayInNameOfThisMonth();
		
		foreach( $this->allNames as $day => $name )
		{
			if( $name === $firstDay )
			{
				return $day;
			}
		}
		throw new \Exception( 'Error with startDayForMonth()' );
	}
	
	public function show()
	{
		$omit_days_count = $this->daysToOmitInCalendar();
		$days_count = $this->getLastDayInNumberOfMonth();
		$day = 1;
		$weekCounter = 0;
		
		$table = '<table class="calendar-table">' . $this->getHeading() . '<tr>';
		
		while( $omit_days_count > 1 )
		{
			$table .= '<td></td>';
			$omit_days_count--;
			$weekCounter++;
		}
		
		while( $day <= $days_count )
		{
			if( $weekCounter == 7 )
			{
				$table .= '</tr><tr>';
				$weekCounter = 0;
			}
			$table .= '<td> <span class="';
			if( $day === $this->todayInNumber() )
			{
				$table .= 'today ';
			}
			if( $event = $this->checkForEvent( $day ) )
			{
				$table .= 'btn btn-primary';
				$table .= '" data-container="body" data-toggle="popover" data-placement="top" data-content="' . $event['description'] . '';
			}
			$table .= '">';
			$table .= "$day";
			$table .= '</span>';
			$day++;
			$weekCounter++;
		}
		$table .= '</tr></table>';
		
		return $table;
	}
}