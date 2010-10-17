<?php


/**
 * Base class that represents a query for the 'session' table.
 *
 * 
 *
 * @method     SessionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SessionQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     SessionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     SessionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     SessionQuery groupById() Group by the id column
 * @method     SessionQuery groupByData() Group by the data column
 * @method     SessionQuery groupByCreatedAt() Group by the created_at column
 * @method     SessionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     SessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Session findOne(PropelPDO $con = null) Return the first Session matching the query
 * @method     Session findOneOrCreate(PropelPDO $con = null) Return the first Session matching the query, or a new Session object populated from the query conditions when no match is found
 *
 * @method     Session findOneById(string $id) Return the first Session filtered by the id column
 * @method     Session findOneByData(string $data) Return the first Session filtered by the data column
 * @method     Session findOneByCreatedAt(string $created_at) Return the first Session filtered by the created_at column
 * @method     Session findOneByUpdatedAt(string $updated_at) Return the first Session filtered by the updated_at column
 *
 * @method     array findById(string $id) Return Session objects filtered by the id column
 * @method     array findByData(string $data) Return Session objects filtered by the data column
 * @method     array findByCreatedAt(string $created_at) Return Session objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Session objects filtered by the updated_at column
 *
 * @package    propel.generator.colony.om
 */
abstract class BaseSessionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSessionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'colony', $modelName = 'Session', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SessionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SessionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SessionQuery) {
			return $criteria;
		}
		$query = new SessionQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Session|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SessionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SessionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SessionPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     string $id The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($id)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $id)) {
				$id = str_replace('*', '%', $id);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SessionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the data column
	 * 
	 * @param     string $data The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByData($data = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($data)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $data)) {
				$data = str_replace('*', '%', $data);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SessionPeer::DATA, $data, $comparison);
	}

	/**
	 * Filter the query on the created_at column
	 * 
	 * @param     string|array $createdAt The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(SessionPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(SessionPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SessionPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Filter the query on the updated_at column
	 * 
	 * @param     string|array $updatedAt The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(SessionPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(SessionPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SessionPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Session $session Object to remove from the list of results
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function prune($session = null)
	{
		if ($session) {
			$this->addUsingAlias(SessionPeer::ID, $session->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     SessionQuery The current query, for fuid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(SessionPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     SessionQuery The current query, for fuid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(SessionPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     SessionQuery The current query, for fuid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(SessionPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     SessionQuery The current query, for fuid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(SessionPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     SessionQuery The current query, for fuid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(SessionPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     SessionQuery The current query, for fuid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(SessionPeer::CREATED_AT);
	}

} // BaseSessionQuery
